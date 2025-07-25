<?php

namespace App\Console\Commands;

use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DebugViewComposer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'debug:view-composer {--user-id= : Specific user ID to debug}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Debug view composer to check project read status';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = $this->option('user-id') ?? 1;
        $user = User::find($userId);

        if (!$user) {
            $this->error("User {$userId} not found");
            return;
        }

        $this->info("Debugging view composer for user: {$user->name} (ID: {$userId}, Role: {$user->role})");

        // Simulate view composer logic
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

        $unreadCount = 0;
        $filteredProjects = [];

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

            if (in_array($status, ['DONE', 'LATE'])) {
                // Cek apakah user sudah membaca notifikasi ini
                $existingRead = DB::table('project_user_reads')
                    ->where('project_id', $project->id)
                    ->where('user_id', $user->id)
                    ->first();

                if (!$existingRead || !$existingRead->read) {
                    $unreadCount++;
                    $project->read = false;
                    $this->line("  🔴 Project {$project->name}: UNREAD (read = false)");
                } else {
                    $project->read = true;
                    $this->line("  ✅ Project {$project->name}: READ (read = true)");
                }

                $filteredProjects[] = $project;
            }
        }

        $this->info("Results:");
        $this->line("  - Filtered projects: " . count($filteredProjects));
        $this->line("  - Unread count: {$unreadCount}");

        foreach ($filteredProjects as $project) {
            $this->line("  - Project: {$project->name} | Read status: " . ($project->read ? 'true' : 'false'));
        }
    }
}
