<?php

namespace App\Console\Commands;

use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckAllProjects extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'projects:check-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check all projects and their statuses';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking all projects...');

        $projects = Project::with(['sprints'])->get();

        foreach ($projects as $project) {
            $startDate = Carbon::parse($project->start_date);
            $endDate = Carbon::parse($project->end_date);
            $today = Carbon::today();

            $totalSprints = $project->sprints->count();
            $completedSprints = $project->sprints->where('status', 'active')->count();

            $calculatedStatus = 'UNKNOWN';

            if ($totalSprints === 0) {
                $calculatedStatus = 'HOLD';
            } elseif ($today->greaterThan($endDate)) {
                $calculatedStatus = $completedSprints < $totalSprints ? 'LATE' : 'DONE';
            } else {
                $calculatedStatus = $completedSprints < $totalSprints ? 'IN PROGRESS' : 'DONE';
            }

            $this->line("Project: {$project->name} (ID: {$project->id})");
            $this->line("  - Current status: {$project->status}");
            $this->line("  - Calculated status: {$calculatedStatus}");
            $this->line("  - End date: {$endDate->format('Y-m-d')}");
            $this->line("  - Today: {$today->format('Y-m-d')}");
            $this->line("  - Total sprints: {$totalSprints}");
            $this->line("  - Completed sprints: {$completedSprints}");
            $this->line("  - Is overdue: " . ($today->greaterThan($endDate) ? 'YES' : 'NO'));
            $this->line("  - Should show in notifications: " . (in_array($calculatedStatus, ['DONE', 'LATE']) ? 'YES' : 'NO'));
            $this->line('');
        }

        $this->info("Total projects: {$projects->count()}");
    }
}
