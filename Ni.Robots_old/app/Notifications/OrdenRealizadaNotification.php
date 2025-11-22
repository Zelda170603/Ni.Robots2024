<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;


class OrdenRealizadaNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $compra;
    protected $producto;
    protected $cantidad;

    public function __construct($compra, $producto, $cantidad)
    {
        $this->compra = $compra;
        $this->producto = $producto;
        $this->cantidad = $cantidad;
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
    public function toArray($notifiable)
    {
        return [
            'type' => 'order',
            'message' => "Se ha realizado una compra.",
            'details' => [
                'compra_id' => $this->compra->compra_id,
                'producto' => $this->producto->nombre_prod,
                'cantidad' => $this->cantidad,
                'total' => $this->compra->total,
            ]
        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'type' => 'order',
            'message' => "Se ha realizado una compra.",
            'details' => [
                'compra_id' => $this->compra->compra_id,
                'producto' => $this->producto->nombre_prod,
                'cantidad' => $this->cantidad,
                'total' => $this->compra->total,
            ]
        ]);
    }
}
