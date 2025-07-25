<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;
use App\Models\Project;
use Carbon\Carbon;

class ForceRefreshNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:force-refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Force refresh notifications by clearing all caches and updating project statuses';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Force refreshing notifications...');

        // Clear all caches
        $this->info('1. Clearing all caches...');
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');

        // Clear project caches
        $this->info('2. Clearing project caches...');
        Artisan::call('project:clear-cache');

        // Refresh project statuses
        $this->info('3. Refreshing project statuses...');
        Artisan::call('project:refresh-status');

        // Force update project_user_reads for LATE projects
        $this->info('4. Updating notification status for LATE projects...');
        $this->updateLateProjectNotifications();

        $this->info('✅ Notifications force refresh completed!');
        $this->info('Please refresh your browser to see the notifications.');
    }

    private function updateLateProjectNotifications()
    {
        $lateProjects = Project::where('status', 'LATE')->get();

        foreach ($lateProjects as $project) {
            $users = User::all();

            foreach ($users as $user) {
                                // Check if user has access to this project
                $hasAccess = $user->role === 'Superadmin' ||
                           $project->user_id === $user->id ||
                           \App\Models\Team::where('project_id', $project->id)
                                           ->where('user_id', $user->id)
                                           ->exists();

                if ($hasAccess) {
                    // Create or update notification record
                    $project->readers()->updateOrCreate(
                        ['user_id' => $user->id],
                        ['read' => false, 'created_at' => now(), 'updated_at' => now()]
                    );

                    $this->line("  - Updated notification for user {$user->name} on project {$project->name}");
                }
            }
        }
    }
}
