<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SellerVerificationNotification extends Notification
{
    use Queueable;

    protected $status;
    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($user, $status)
    {
        $this->user = $user;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        $message = $this->status === 'verified'
            ? 'Permintaan Anda menjadi seller telah diterima!'
            : 'Maaf, permintaan Anda menjadi seller telah ditolak.';

        return [
            'status' => $this->status,
            'message' => $message,
            'store_name' => $this->user->store_name,
        ];
    }
}
