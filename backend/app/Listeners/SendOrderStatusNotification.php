<?php

namespace App\Listeners;

use App\Events\OrderStatusChanged;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendOrderStatusNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct(
        protected NotificationService $notificationService
    ) {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderStatusChanged $event): void
    {
        try {
            // Send status update notification to customer
            $result = $this->notificationService->sendOrderStatusUpdate(
                $event->order, 
                $event->previousStatus
            );
            
            Log::info('Order status notification result', [
                'order_id' => $event->order->id,
                'previous_status' => $event->previousStatus,
                'current_status' => $event->order->status,
                'result' => $result
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send order status notification', [
                'order_id' => $event->order->id,
                'error' => $e->getMessage()
            ]);
            
            throw $e;
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(OrderStatusChanged $event, \Throwable $exception): void
    {
        Log::error('Order status notification job failed permanently', [
            'order_id' => $event->order->id,
            'error' => $exception->getMessage()
        ]);
    }
}
