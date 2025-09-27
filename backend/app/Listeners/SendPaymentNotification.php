<?php

namespace App\Listeners;

use App\Events\PaymentConfirmed;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendPaymentNotification implements ShouldQueue
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
    public function handle(PaymentConfirmed $event): void
    {
        try {
            // Send payment confirmation to customer
            $result = $this->notificationService->sendPaymentConfirmation($event->payment);
            
            Log::info('Payment confirmation notification result', [
                'payment_id' => $event->payment->id,
                'order_id' => $event->payment->order->id,
                'result' => $result
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send payment confirmation', [
                'payment_id' => $event->payment->id,
                'error' => $e->getMessage()
            ]);
            
            throw $e;
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(PaymentConfirmed $event, \Throwable $exception): void
    {
        Log::error('Payment notification job failed permanently', [
            'payment_id' => $event->payment->id,
            'error' => $exception->getMessage()
        ]);
    }
}
