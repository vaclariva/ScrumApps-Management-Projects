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
        // Cek apakah email host sudah dikonfigurasi
        if (!\App\Helpers\Helper::isEmailHostConfigured()) {
            Log::warning('Sprint reminder tidak dikirim karena email host belum dikonfigurasi');
            return;
        }

        $sprints = Sprint::where('end_date', '>=', now()->startOfDay())
                        ->where('end_date', '<=', now()->copy()->addDays(3)->endOfDay())
                        ->where('status', 'inactive')
                        ->get();

        foreach ($sprints as $sprint) {
            $project = $sprint->project;
            $businessAnalyst = $project->businessAnalyst;

            if (!$businessAnalyst || !$businessAnalyst->email) {
                Log::info("⛔ Sprint '{$sprint->name}' tidak punya Business Analyst atau email.");
                continue;
            }

            $now = now();
            $endDate = \Carbon\Carbon::parse($sprint->end_date);
            $daysLeft = floor($now->diffInDays($endDate, false));

            if (in_array($daysLeft, [3, 2, 1, 0])) {
                Mail::to($businessAnalyst->email)->send(new SprintReminder($sprint, $daysLeft));
            } else {
                Log::info("✅ Sprint '{$sprint->name}' belum perlu dikirimi reminder.");
            }

            // Kirim ke semua anggota tim developer
            $teamMembers = $project->teams; // relasi ke Team
            foreach ($teamMembers as $team) {
                $developer = $team->user; // pastikan relasi 'user' ada di model Team
                if ($developer && $developer->email) {
                    Mail::to($developer->email)->send(new SprintReminder($sprint, $daysLeft));
                }
            }
        }
    }
}
