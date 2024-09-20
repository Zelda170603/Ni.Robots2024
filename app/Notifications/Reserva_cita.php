<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

use function PHPSTORM_META\type;

class Reserva_cita extends Notification
{
    use Queueable;
    private $type;
    private $sender;
    /**
     * Create a new notification instance.
     */
    public function __construct($type, $sender)
    {
        $this->type = $type;
        $this->sender = $sender;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
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
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'appointment',
            'message' => "Tienes una nueva solicitud para una cita",
            'sender' => [
                'name' => $this->sender['name'],
                'avatar' => $this->sender['avatar'],
            ],
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'type' => 'reserva_cita',
            'message' => "Tienes una nueva solicitud para una cita",
            'sender' => [
                'name' => $this->sender['name'],
                'avatar' => $this->sender['avatar'],
            ],
        ]);
    }
}
