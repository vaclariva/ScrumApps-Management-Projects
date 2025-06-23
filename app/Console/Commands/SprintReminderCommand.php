<?php

namespace App\Console\Commands;

use App\Mail\SprintReminder;
use Illuminate\Console\Command;
use App\Models\Sprint;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SprintReminderCommand extends Command
{
    protected $signature = 'sprint:remind';
    protected $description = 'Send reminders for sprints nearing their deadline';

    public function handle()
    {
        $sprints = Sprint::where('end_date', '>=', now()->startOfDay())
                        ->where('end_date', '<=', now()->copy()->addDays(3)->endOfDay())
                        ->where('status', 'inactive')
                        ->get();

        foreach ($sprints as $sprint) {
            $project = $sprint->project;
            $productOwner = $project->productOwner;

            if (!$productOwner || !$productOwner->email) {
                Log::info("⛔ Sprint '{$sprint->name}' tidak punya Product Owner atau email.");
                continue;
            }

            $now = now();
            $endDate = \Carbon\Carbon::parse($sprint->end_date);
            $daysLeft = floor($now->diffInDays($endDate, false));

            if (in_array($daysLeft, [3, 2, 1])) {
                Mail::to($productOwner->email)->send(new SprintReminder($sprint, $daysLeft));
            }
            elseif ($now->isSameDay($endDate) && $now->greaterThan($endDate)) {
                Mail::to($productOwner->email)->send(new SprintReminder($sprint, 0));
            }
            else {
                Log::info("✅ Sprint '{$sprint->name}' belum perlu dikirimi reminder.");
            }
        }
    }
}
