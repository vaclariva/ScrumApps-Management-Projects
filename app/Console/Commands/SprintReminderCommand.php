<?php

namespace App\Console\Commands;

use App\Mail\SprintReminder;
use Illuminate\Console\Command;
use App\Models\Sprint;
use App\Models\Project;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SprintReminderCommand extends Command
{
    protected $signature = 'sprint:remind';
    protected $description = 'Send reminders for sprints nearing their deadline';

    public function handle()
    {
        Log::info('Sprint reminder command running...');
        // Ambil sprint yang kurang dari 3 hari
        $sprints = Sprint::whereDate('end_date', '<=', now()->addDays(3))
                         ->where('status', 'inactive')
                         ->get();

        foreach ($sprints as $sprint) {
            $project = $sprint->project;
            $productOwner = $project->productOwner;

            if ($productOwner) {
                Mail::to($productOwner->email)->send(new SprintReminder($sprint));
                Log::info("Email reminder sent to {$productOwner->email} for sprint '{$sprint->name}' - {$sprint->days_left} hari tersisa");
            }
        }

        $this->info('Sprint reminder command executed.');
    }
}
