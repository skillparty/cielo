<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use App\Mail\OrderConfirmation;
use App\Mail\OrderStatusUpdate;
use App\Mail\PaymentConfirmation;
use App\Mail\NewOrderNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

class NotificationService
{
    /**
     * Check if customer notifications are enabled
     */
    protected function isCustomerNotificationEnabled(string $type): bool
    {
        return Config::get("notifications.customer_emails.{$type}", true);
    }

    /**
     * Check if admin notifications are enabled
     */
    protected function isAdminNotificationEnabled(string $type): bool
    {
        return Config::get("notifications.admin_emails.{$type}", true);
    }

    /**
     * Send order confirmation email to customer
     */
    public function sendOrderConfirmation(Order $order): bool
    {
        if (!$this->isCustomerNotificationEnabled('order_confirmation')) {
            Log::info('Order confirmation disabled by configuration', ['order_id' => $order->id]);
            return false;
        }

        try {
            if (!$order->user) {
                Log::warning('Cannot send order confirmation: Order has no user', ['order_id' => $order->id]);
                return false;
            }

            Mail::to($order->user->email)->send(new OrderConfirmation($order));
            
            Log::info('Order confirmation sent', [
                'order_id' => $order->id,
                'user_id' => $order->user->id,
                'email' => $order->user->email
            ]);
            
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send order confirmation', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Send order status update email to customer
     */
    public function sendOrderStatusUpdate(Order $order, string $previousStatus): bool
    {
        try {
            Mail::to($order->user->email)
                ->send(new OrderStatusUpdate($order, $previousStatus, $order->status));
            
            Log::info('Order status update email sent', [
                'order_id' => $order->id,
                'previous_status' => $previousStatus,
                'current_status' => $order->status,
                'customer_email' => $order->user->email
            ]);
            
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send order status update email', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);
            
            return false;
        }
    }

    /**
     * Send payment confirmation email to customer
     */
    public function sendPaymentConfirmation(Payment $payment): bool
    {
        try {
            Mail::to($payment->order->user->email)
                ->send(new PaymentConfirmation($payment));
            
            Log::info('Payment confirmation email sent', [
                'payment_id' => $payment->id,
                'order_id' => $payment->order->id,
                'customer_email' => $payment->order->user->email
            ]);
            
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send payment confirmation email', [
                'payment_id' => $payment->id,
                'error' => $e->getMessage()
            ]);
            
            return false;
        }
    }

    /**
     * Send new order notification to administrators
     */
    public function sendNewOrderNotification(Order $order): bool
    {
        try {
            // Get admin emails from users with admin roles
            $adminEmails = User::role(['super-admin', 'admin', 'moderator'])
                ->pluck('email')
                ->toArray();

            if (empty($adminEmails)) {
                // Fallback to config email
                $adminEmails = [config('mail.admin.address', 'admin@cielocarnes.com')];
            }

            Mail::to($adminEmails)
                ->send(new NewOrderNotification($order));
            
            Log::info('New order notification sent to admins', [
                'order_id' => $order->id,
                'admin_emails' => $adminEmails
            ]);
            
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send new order notification', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);
            
            return false;
        }
    }

    /**
     * Send multiple notifications for a new order
     */
    public function sendNewOrderNotifications(Order $order): array
    {
        $results = [];
        
        // Send confirmation to customer
        $results['customer_confirmation'] = $this->sendOrderConfirmation($order);
        
        // Send notification to admins
        $results['admin_notification'] = $this->sendNewOrderNotification($order);
        
        return $results;
    }

    /**
     * Send payment verification reminder (for QR payments)
     */
    public function sendPaymentVerificationReminder(Payment $payment): bool
    {
        try {
            // This could be a different mailable for payment reminders
            // For now, we'll use a simple approach
            
            $order = $payment->order;
            $subject = "Recordatorio: Verificación de Pago Pendiente - Pedido #{$order->order_number}";
            
            Mail::raw(
                "Hola {$order->user->name},\n\n" .
                "Te recordamos que tu pago para el pedido #{$order->order_number} está pendiente de verificación.\n\n" .
                "Si ya realizaste el pago, por favor asegúrate de haber subido el comprobante correctamente.\n\n" .
                "Si tienes alguna pregunta, no dudes en contactarnos.\n\n" .
                "Saludos,\nEl equipo de Cielo Carnes",
                function ($message) use ($order, $subject) {
                    $message->to($order->user->email)
                           ->subject($subject);
                }
            );
            
            Log::info('Payment verification reminder sent', [
                'payment_id' => $payment->id,
                'order_id' => $order->id
            ]);
            
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send payment verification reminder', [
                'payment_id' => $payment->id,
                'error' => $e->getMessage()
            ]);
            
            return false;
        }
    }

    /**
     * Send bulk notifications to customers
     */
    public function sendBulkNotification(array $userIds, string $subject, string $message): array
    {
        $results = [];
        
        $users = User::whereIn('id', $userIds)->get();
        
        foreach ($users as $user) {
            try {
                Mail::raw($message, function ($mail) use ($user, $subject) {
                    $mail->to($user->email)
                         ->subject($subject);
                });
                
                $results[$user->id] = true;
            } catch (\Exception $e) {
                Log::error('Failed to send bulk notification', [
                    'user_id' => $user->id,
                    'error' => $e->getMessage()
                ]);
                
                $results[$user->id] = false;
            }
        }
        
        return $results;
    }

    /**
     * Test email configuration
     */
    public function testEmailConfiguration(string $testEmail = null): bool
    {
        try {
            $email = $testEmail ?? config('mail.admin.address', 'admin@cielocarnes.com');
            
            Mail::raw(
                "Este es un email de prueba del sistema de notificaciones de Cielo Carnes.\n\n" .
                "Si recibes este mensaje, la configuración de email está funcionando correctamente.\n\n" .
                "Enviado el: " . now()->format('d/m/Y H:i:s') . "\n\n" .
                "Sistema de Notificaciones - Cielo Carnes",
                function ($message) use ($email) {
                    $message->to($email)
                           ->subject('🧪 Test de Configuración de Email - Cielo Carnes');
                }
            );
            
            Log::info('Test email sent successfully', ['email' => $email]);
            
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send test email', [
                'error' => $e->getMessage()
            ]);
            
            return false;
        }
    }
}