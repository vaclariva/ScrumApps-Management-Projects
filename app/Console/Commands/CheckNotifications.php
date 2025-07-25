<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CheckNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check current notification status in project_user_reads table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking notification status...');

        $records = DB::table('project_user_reads')
            ->join('projects', 'project_user_reads.project_id', '=', 'projects.id')
            ->join('users', 'project_user_reads.user_id', '=', 'users.id')
            ->select(
                'project_user_reads.*',
                'projects.name as project_name',
                'projects.status as project_status',
                'users.name as user_name'
            )
            ->get();

        if ($records->isEmpty()) {
            $this->warn('No notification records found in project_user_reads table');
            return;
        }

        $this->info("Found {$records->count()} notification records:");
        $this->line('');

        foreach ($records as $record) {
            $status = $record->read ? '✅ READ' : '🔴 UNREAD';
            $this->line("{$status} - User: {$record->user_name} | Project: {$record->project_name} ({$record->project_status}) | Created: {$record->created_at}");
        }

        $totalRecords = DB::table('project_user_reads')->count();
        $unreadRecords = DB::table('project_user_reads')->where('read', false)->count();
        $readRecords = DB::table('project_user_reads')->where('read', true)->count();

        $this->line('');
        $this->info("Summary:");
        $this->line("  - Total records: {$totalRecords}");
        $this->line("  - Unread records: {$unreadRecords}");
        $this->line("  - Read records: {$readRecords}");
    }
}
