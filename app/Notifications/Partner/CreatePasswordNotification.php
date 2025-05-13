<?php

namespace App\Notifications\Partner;

use App\Models\Partner;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CreatePasswordNotification extends Notification
{
    use Queueable;

    /**
     * Define properties.
     */
    protected string $url;

    protected Partner $partner;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $url, Partner $partner)
    {
        $this->url = $url;
        $this->partner = $partner;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Pemberitahuan Pengaturan Kata Sandi Baru')
            ->view('notifications.create-password-partner', [
                'url' => $this->url,
                'partner' => $this->partner,
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
