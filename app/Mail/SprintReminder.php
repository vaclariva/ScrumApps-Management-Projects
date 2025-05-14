<?php

namespace App\Mail;

use App\Models\Sprint;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SprintReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $sprint;
    public $daysLeft;

    public function __construct(Sprint $sprint)
    {
        $this->sprint = $sprint;
        $this->daysLeft = $sprint->getDaysLeftAttribute();
    }

    public function build()
    {
        return $this->subject($this->generateSubject())
                    ->view('notifications.reminder-sprint');
    }

    private function generateSubject()
    {
        if ($this->daysLeft >= 0) {
            return "🚨 Sprint Gagal Diselesaikan!";
        } else {
            return "⏳ Sprint Akan Berakhir dalam {$this->daysLeft} Hari";
        }
    }
}
