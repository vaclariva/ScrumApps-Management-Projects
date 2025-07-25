<?php

namespace App\Console\Commands;

use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class DebugNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:debug {--user-id= : Specific user ID to debug}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Debug notification logic to see why notifications are not showing';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = $this->option('user-id');

        if ($userId) {
            $this->debugUserNotifications($userId);
        } else {
            $users = User::all();
            $this->info("Debugging notifications for {$users->count()} users...");

            foreach ($users as $user) {
                $this->debugUserNotifications($user->id);
                $this->line('---');
            }
        }
    }

    private function debugUserNotifications($userId)
    {
        $user = User::find($userId);
        if (!$user) {
            $this->error("User {$userId} not found");
            return;
        }

        $this->info("Debugging notifications for user: {$user->name} (ID: {$userId}, Role: {$user->role})");

        // Get projects for this user
        $projects = Project::with(['user', 'sprints', 'readers'])
            ->when($user->role !== 'Superadmin', function ($query) use ($user) {
                $query->where(function ($q) use ($user) {
                    $q->where('user_id', $user->id)
                    ->orWhereIn('id', function ($subQuery) use ($user) {
                        $subQuery->select('project_id')
                            ->from('teams')
                            ->where('user_id', $user->id);
                    });
                });
            })
            ->latest()
            ->get();

        $this->line("Total projects for user: {$projects->count()}");

        $filteredProjects = [];
        $unreadCount = 0;

        foreach ($projects as $project) {
            $startDate = Carbon::parse($project->start_date);
            $endDate = Carbon::parse($project->end_date);
            $today = Carbon::today();

            $totalSprints = $project->sprints->count();
            $completedSprints = $project->sprints->where('status', 'active')->count();

            $status = 'UNKNOWN';

            if ($totalSprints === 0) {
                $status = 'HOLD';
            } elseif ($today->greaterThan($endDate)) {
                $status = $completedSprints < $totalSprints ? 'LATE' : 'DONE';
            } else {
                $status = $completedSprints < $totalSprints ? 'IN PROGRESS' : 'DONE';
            }

            $this->line("Project: {$project->name} (ID: {$project->id})");
            $this->line("  - Current status: {$project->status}");
            $this->line("  - Calculated status: {$status}");
            $this->line("  - End date: {$endDate->format('Y-m-d')}");
            $this->line("  - Today: {$today->format('Y-m-d')}");
            $this->line("  - Total sprints: {$totalSprints}");
            $this->line("  - Completed sprints: {$completedSprints}");
            $this->line("  - Is overdue: " . ($today->greaterThan($endDate) ? 'YES' : 'NO'));

            if (in_array($status, ['DONE', 'LATE'])) {
                $filteredProjects[] = $project;
                $this->line("  - ✅ Included in notifications (status: {$status})");

                $isRead = $project->readers()
                    ->where('user_id', $user->id)
                    ->where('read', true)
                    ->exists();

                if (!$isRead) {
                    $unreadCount++;
                    $this->line("  - 🔴 UNREAD notification");
                } else {
                    $this->line("  - ✅ Already read");
                }
            } else {
                $this->line("  - ❌ Not included in notifications (status: {$status})");
            }
        }

        $this->info("Results for user {$user->name}:");
        $this->line("  - Filtered projects: " . count($filteredProjects));
        $this->line("  - Unread count: {$unreadCount}");

        // Check cache
        $cacheKey = "user_projects_{$userId}";
        $cachedData = Cache::get($cacheKey);
        if ($cachedData) {
            $this->line("  - Cache exists with unread count: {$cachedData['unreadCount']}");
        } else {
            $this->line("  - No cache found");
        }
    }
}
