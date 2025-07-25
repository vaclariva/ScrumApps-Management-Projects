<?php

namespace App\Console\Commands;

use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RefreshProjectStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:refresh-status {--project-id= : Specific project ID to refresh}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh project statuses based on sprint completion and deadlines';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $projectId = $this->option('project-id');

        $query = Project::with(['sprints']);

        if ($projectId) {
            $query->where('id', $projectId);
        }

        $projects = $query->get();

        $this->info("Found {$projects->count()} projects to process...");

        foreach ($projects as $project) {
            $this->processProject($project);
        }

        $this->info('Project status refresh completed!');
    }

    private function processProject($project)
    {
        $startDate = Carbon::parse($project->start_date);
        $endDate = Carbon::parse($project->end_date);
        $today = Carbon::today();

        $totalSprints = $project->sprints->count();
        $completedSprints = $project->sprints->where('status', 'active')->count();

        $oldStatus = $project->status;
        $newStatus = 'UNKNOWN';

        if ($totalSprints === 0) {
            $newStatus = 'HOLD';
        } elseif ($today->greaterThan($endDate)) {
            $newStatus = $completedSprints < $totalSprints ? 'LATE' : 'DONE';
        } else {
            $newStatus = $completedSprints < $totalSprints ? 'IN PROGRESS' : 'DONE';
        }

        if ($oldStatus !== $newStatus) {
            $project->update(['status' => $newStatus]);
            $this->info("Project {$project->id} ({$project->name}): {$oldStatus} → {$newStatus}");
        } else {
            $this->line("Project {$project->id} ({$project->name}): {$oldStatus} (no change)");
        }

        // Debug info
        $this->line("  - Total sprints: {$totalSprints}");
        $this->line("  - Completed sprints: {$completedSprints}");
        $this->line("  - End date: {$endDate->format('Y-m-d')}");
        $this->line("  - Today: {$today->format('Y-m-d')}");
        $this->line("  - Is overdue: " . ($today->greaterThan($endDate) ? 'YES' : 'NO'));
    }
}
