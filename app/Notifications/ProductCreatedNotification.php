<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProductCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $products;
    public function __construct($products)
    {
        $this->products = $products;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('via ' . $notifiable->name)
            ->action('Notification Action', url('product/edit/' . $this->products->first()->id))
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
            'message' => 'new product created successfully !',
            'link' => url('product/edit/' . $this->products->first()->id),
        ];
    }
}
