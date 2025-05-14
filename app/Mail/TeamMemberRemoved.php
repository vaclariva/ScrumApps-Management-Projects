<?php

namespace App\Mail;

use App\Models\Team;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TeamMemberRemoved extends Mailable
{
    use Queueable, SerializesModels;

    public $team;

    public function __construct(Team $team)
    {
        $this->team = $team;
    }

    public function build()
    {
        $roleLabels = [
            'ui/ux' => 'UI/UX',
            'backend' => 'BackEnd',
            'frontend' => 'FrontEnd',
            'fullstack' => 'FullStack',
            'quality_assurance' => 'Quality Assurance',
        ];
        $role = $roleLabels[$this->team->role];
        $projectName = $this->team->project->name;
        $member = $this->team->user->name;

        return $this->subject("Pemberitahuan: Anda Telah Dikeluarkan dari $projectName")
                    ->view('notifications.remove-team')
                     ->with([
                        'role' => $role,
                        'projectName' => $projectName,
                        'member' => $member,
                        'team' => $this->team,
                    ]);
    }
}
