<?php

namespace App\Console\Commands;

use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ForceUpdateNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:force-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Force update notification records in project_user_reads table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Force updating notification records...');

        $lateProjects = Project::where('status', 'LATE')->get();
        $doneProjects = Project::where('status', 'DONE')->get();

        $this->info("Found {$lateProjects->count()} LATE projects and {$doneProjects->count()} DONE projects");

        $allProjects = $lateProjects->merge($doneProjects);

        foreach ($allProjects as $project) {
            $this->info("Processing project: {$project->name} (Status: {$project->status})");

            // Get all users who should receive notifications for this project
            $users = User::all();

            foreach ($users as $user) {
                // Check if user has access to this project
                $hasAccess = $user->role === 'Superadmin' ||
                           $project->user_id === $user->id ||
                           DB::table('teams')
                               ->where('project_id', $project->id)
                               ->where('user_id', $user->id)
                               ->exists();

                if ($hasAccess) {
                    // Create or update notification record
                    $existingRecord = DB::table('project_user_reads')
                        ->where('project_id', $project->id)
                        ->where('user_id', $user->id)
                        ->first();

                    if (!$existingRecord) {
                        // Create new record
                        DB::table('project_user_reads')->insert([
                            'project_id' => $project->id,
                            'user_id' => $user->id,
                            'read' => false,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);

                        $this->line("  ✅ Created notification for user: {$user->name}");
                    } else {
                        // Update existing record if not read
                        if (!$existingRecord->read) {
                            DB::table('project_user_reads')
                                ->where('project_id', $project->id)
                                ->where('user_id', $user->id)
                                ->update([
                                    'read' => false,
                                    'updated_at' => now()
                                ]);

                            $this->line("  ✅ Updated notification for user: {$user->name}");
                        } else {
                            $this->line("  ⏭️  User {$user->name} already read this notification");
                        }
                    }
                } else {
                    $this->line("  ❌ User {$user->name} has no access to this project");
                }
            }
        }

        // Show summary
        $totalRecords = DB::table('project_user_reads')->count();
        $unreadRecords = DB::table('project_user_reads')->where('read', false)->count();

        $this->info("✅ Force update completed!");
        $this->info("Total notification records: {$totalRecords}");
        $this->info("Unread notification records: {$unreadRecords}");
    }
}
