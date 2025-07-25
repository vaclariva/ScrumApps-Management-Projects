<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use App\Models\User;

class ClearProjectCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:clear-cache {--user-id= : Specific user ID to clear cache}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear project cache to force refresh notifications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = $this->option('user-id');

        if ($userId) {
            $this->clearUserCache($userId);
        } else {
            $users = User::all();
            $this->info("Clearing cache for {$users->count()} users...");

            foreach ($users as $user) {
                $this->clearUserCache($user->id);
            }
        }

        $this->info('Project cache cleared successfully!');
    }

    private function clearUserCache($userId)
    {
        $cacheKey = "user_projects_{$userId}";
        $deleted = Cache::forget($cacheKey);

        if ($deleted) {
            $this->info("Cache cleared for user {$userId}");
        } else {
            $this->line("No cache found for user {$userId}");
        }
    }
}
