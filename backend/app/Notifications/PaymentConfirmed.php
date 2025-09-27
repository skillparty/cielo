<?php

namespace App\Notifications;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentConfirmed extends Notification implements ShouldQueue
{
    use Queueable;

    public $order;
    public $payment;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order, Payment $payment = null)
    {
        $this->order = $order;
        $this->payment = $payment;
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
            ->subject('Pago Confirmado - Pedido #' . $this->order->order_number)
            ->view('emails.payment-confirmed', [
                'order' => $this->order,
                'payment' => $this->payment,
                'user' => $notifiable
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
            'order_id' => $this->order->id,
            'order_number' => $this->order->order_number,
            'payment_id' => $this->payment?->id,
            'payment_amount' => $this->payment?->amount ?? $this->order->total_amount,
            'payment_method' => $this->payment?->payment_method ?? 'unknown',
            'message' => "Pago confirmado para el pedido #{$this->order->order_number}",
            'action_url' => route('orders.show', $this->order),
            'created_at' => now()
        ];
    }

    /**
     * Get the notification's database type.
     */
    public function databaseType(object $notifiable): string
    {
        return 'payment_confirmed';
    }
}