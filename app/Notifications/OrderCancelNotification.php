<?php

// app/Notifications/OrderCancelNotification.php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class OrderCancelNotification extends Notification
{
    use Queueable;

    public $order;
    public $orderItem;

    public function __construct($order, $orderItem, $user)
    {
        $this->order = $order;
        $this->orderItem = $orderItem;
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Order Cancel Notification')
            ->markdown('emails.order_cancel_notification', [
                'order' => $this->order,
                'orderItem' => $this->orderItem,
                'user' => $this->user
            ]);
    }
}
