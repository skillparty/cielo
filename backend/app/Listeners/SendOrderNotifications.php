<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendOrderNotifications implements ShouldQueue
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
    public function handle(OrderCreated $event): void
    {
        try {
            // Send all notifications for the new order
            $results = $this->notificationService->sendNewOrderNotifications($event->order);
            
            Log::info('Order notification results', [
                'order_id' => $event->order->id,
                'results' => $results
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send order notifications', [
                'order_id' => $event->order->id,
                'error' => $e->getMessage()
            ]);
            
            // Re-throw to retry the job
            throw $e;
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(OrderCreated $event, \Throwable $exception): void
    {
        Log::error('Order notifications job failed permanently', [
            'order_id' => $event->order->id,
            'error' => $exception->getMessage()
        ]);
    }
}
