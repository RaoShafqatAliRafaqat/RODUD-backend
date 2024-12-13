<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
    use Queueable;

    private $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }
    public function toArray($notifiable)
    {
        return [
            'message' => 'A new order has been placed.',
        ];
    }
    public function toBroadcast($notifiable)
    {
        return [
            'data' => [
                'order_id' => $this->order->id,
                'message' => 'A new order has been placed.',
                'location' => $this->order->location,
                'pickup_time' => $this->order->pickup_time,
            ],
        ];
    }
    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'message' => 'A new order has been placed.',
            'location' => $this->order->location,
            'pickup_time' => $this->order->pickup_time,
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Order Placed')
            ->line('A new order has been placed.')
            ->line('Location: ' . $this->order->location)
            ->line('Pickup Time: ' . $this->order->pickup_time)
            ->action('View Order', url('/admin/orders'))
            ->line('Thank you for using our application!');
    }
}
