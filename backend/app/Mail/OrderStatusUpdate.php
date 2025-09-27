<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderStatusUpdate extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public Order $order,
        public string $previousStatus,
        public string $currentStatus
    ) {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $statusMessages = [
            'pending' => 'Pedido Recibido',
            'confirmed' => 'Pedido Confirmado',
            'preparing' => 'Preparando tu Pedido',
            'ready' => 'Pedido Listo para Entrega',
            'shipped' => 'Pedido en Camino',
            'delivered' => 'Pedido Entregado',
            'cancelled' => 'Pedido Cancelado',
        ];

        $subject = $statusMessages[$this->currentStatus] ?? 'Actualización de Pedido';
        
        return new Envelope(
            subject: $subject . ' - Pedido #' . $this->order->order_number,
            from: config('mail.from.address', 'noreply@cielocarnes.com'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.orders.status-update',
            with: [
                'order' => $this->order,
                'customer' => $this->order->user,
                'previousStatus' => $this->previousStatus,
                'currentStatus' => $this->currentStatus,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
