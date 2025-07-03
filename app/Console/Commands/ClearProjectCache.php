<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ClearProjectCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:clear-projects {user_id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear project-related caches for better performance';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = $this->argument('user_id');

        if ($userId) {
            // Clear specific user cache
            Cache::forget("user_projects_{$userId}");
            Cache::forget("dashboard_data_{$userId}");
            $this->info("Cleared cache for user ID: {$userId}");
        } else {
            // Clear all project-related caches
            $this->info('Clearing all project-related caches...');

            // Get all cache keys and clear project-related ones
            $keys = Cache::get('cache_keys', []);

            foreach ($keys as $key) {
                if (str_contains($key, 'user_projects_') || str_contains($key, 'dashboard_data_')) {
                    Cache::forget($key);
                }
            }

            $this->info('All project caches cleared successfully!');
        }

        return Command::SUCCESS;
    }
}
