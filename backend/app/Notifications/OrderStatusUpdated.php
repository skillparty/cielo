<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderStatusUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    public $order;
    public $previousStatus;
    public $statusNotes;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order, string $previousStatus = null, string $statusNotes = null)
    {
        $this->order = $order;
        $this->previousStatus = $previousStatus;
        $this->statusNotes = $statusNotes;
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
        $subject = $this->getSubjectByStatus();
        
        return (new MailMessage)
            ->subject($subject . ' - Pedido #' . $this->order->order_number)
            ->view('emails.order-status-updated', [
                'order' => $this->order,
                'previousStatus' => $this->previousStatus,
                'statusNotes' => $this->statusNotes,
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
            'status' => $this->order->status,
            'previous_status' => $this->previousStatus,
            'status_notes' => $this->statusNotes,
            'message' => $this->getMessageByStatus(),
            'action_url' => route('orders.show', $this->order),
            'created_at' => now()
        ];
    }

    /**
     * Get the notification's database type.
     */
    public function databaseType(object $notifiable): string
    {
        return 'order_status_updated';
    }

    /**
     * Get email subject based on order status.
     */
    private function getSubjectByStatus(): string
    {
        return match ($this->order->status) {
            'processing' => 'Preparando tu Pedido',
            'shipped' => 'Tu Pedido está en Camino',
            'delivered' => 'Pedido Entregado',
            'cancelled' => 'Pedido Cancelado',
            default => 'Actualización de Pedido'
        };
    }

    /**
     * Get notification message based on order status.
     */
    private function getMessageByStatus(): string
    {
        return match ($this->order->status) {
            'processing' => "Tu pedido #{$this->order->order_number} está siendo preparado",
            'shipped' => "Tu pedido #{$this->order->order_number} está en camino",
            'delivered' => "Tu pedido #{$this->order->order_number} ha sido entregado",
            'cancelled' => "Tu pedido #{$this->order->order_number} ha sido cancelado",
            default => "Estado actualizado para el pedido #{$this->order->order_number}"
        };
    }
}