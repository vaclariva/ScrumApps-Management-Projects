<?php

namespace App\Console\Commands;

use App\Models\Sprint;
use Illuminate\Console\Command;

class CheckSprints extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sprints:check-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check all sprints and their statuses';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking all sprints...');

        $sprints = Sprint::with(['project'])->get();

        if ($sprints->isEmpty()) {
            $this->warn('No sprints found');
            return;
        }

        foreach ($sprints as $sprint) {
            $this->line("Sprint: {$sprint->name} (ID: {$sprint->id})");
            $this->line("  - Project: {$sprint->project->name}");
            $this->line("  - Status: {$sprint->status}");
            $this->line("  - Start date: {$sprint->start_date}");
            $this->line("  - End date: {$sprint->end_date}");
            $this->line("  - Is completed: " . ($sprint->status === 'active' ? 'YES' : 'NO'));
            $this->line('');
        }

        $this->info("Total sprints: {$sprints->count()}");
        $this->info("Active (completed) sprints: " . $sprints->where('status', 'active')->count());
        $this->info("Inactive (not completed) sprints: " . $sprints->where('status', 'inactive')->count());
    }
}
