<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReplyFalseToRequestToOpenHotelNotification extends Notification
{
    use Queueable;

    protected $hotel;
    // protected $status;
    /**
     * Create a new notification instance.
     */
    public function __construct($hotel)//, $status)
    {
        $this->hotel = $hotel;
        // $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $owner = $this->hotel->hotel_owner;
        // dd($owner);
        return (new MailMessage)
            ->subject("The request to open the {$this->hotel->trade_name} hotel was rejected.")
            ->greeting("Hi {$owner->identity->full_name},")
            ->line("The request to open the {$this->hotel->trade_name} hotel was rejected.")
            ->line('Please check from Tourism Office.');
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        return [
            'body' => "The request to open the {$this->hotel->trade_name} hotel was rejected. Please check from Tourism Office.",
            'icon' => 'fas fa-file',
            'url' => url('/hotel/instanc/'),
            'id' => $this->hotel->id,
        ];
    }

    /**
     * Get the broadcast representation of the notification.
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'body' => "The request to open the hotel {$this->hotel->trade_name} has been accepted.",
            'icon' => 'fas fa-file',
            'url' => url('/hotel/instanc/'),
            'id' => $this->hotel->id,
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
