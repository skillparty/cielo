<?php

namespace App\Console\Commands;

use App\Services\NotificationService;
use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Console\Command;

class TestNotifications extends Command
{
    protected $signature = 'notifications:test {type?} {--user-id=} {--order-id=} {--payment-id=}';
    protected $description = 'Test notification system';

    protected NotificationService $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        parent::__construct();
        $this->notificationService = $notificationService;
    }

    public function handle()
    {
        $type = $this->argument('type');

        if (!$type) {
            $this->showMenu();
            return;
        }

        try {
            switch ($type) {
                case 'order-confirmation':
                    $this->testOrderConfirmation();
                    break;
                case 'status-update':
                    $this->testOrderStatusUpdate();
                    break;
                case 'payment-confirmation':
                    $this->testPaymentConfirmation();
                    break;
                case 'new-order-admin':
                    $this->testNewOrderAdmin();
                    break;
                case 'all':
                    $this->testAll();
                    break;
                default:
                    $this->error("Tipo de notificación no válido: {$type}");
                    $this->showMenu();
            }
        } catch (\Exception $e) {
            $this->error("Error al enviar notificación: " . $e->getMessage());
        }
    }

    private function showMenu()
    {
        $this->info('Tipos de notificación disponibles:');
        $this->line('- order-confirmation: Confirmación de pedido');
        $this->line('- status-update: Actualización de estado');
        $this->line('- payment-confirmation: Confirmación de pago');
        $this->line('- new-order-admin: Nuevo pedido (admin)');
        $this->line('- all: Enviar todas las notificaciones de prueba');
        $this->line('');
        $this->info('Uso:');
        $this->line('php artisan notifications:test order-confirmation --user-id=1 --order-id=1');
    }

    private function testOrderConfirmation()
    {
        $userId = $this->option('user-id') ?: $this->getRandomUserId();
        $orderId = $this->option('order-id') ?: $this->getRandomOrderId();

        $user = User::findOrFail($userId);
        $order = Order::findOrFail($orderId);

        $this->info("Enviando confirmación de pedido a: {$user->email}");
        $this->notificationService->sendOrderConfirmation($user, $order);
        $this->info('✓ Notificación enviada');
    }

    private function testOrderStatusUpdate()
    {
        $userId = $this->option('user-id') ?: $this->getRandomUserId();
        $orderId = $this->option('order-id') ?: $this->getRandomOrderId();

        $user = User::findOrFail($userId);
        $order = Order::findOrFail($orderId);

        $this->info("Enviando actualización de estado a: {$user->email}");
        $this->notificationService->sendOrderStatusUpdate($user, $order, 'processing');
        $this->info('✓ Notificación enviada');
    }

    private function testPaymentConfirmation()
    {
        $userId = $this->option('user-id') ?: $this->getRandomUserId();
        $paymentId = $this->option('payment-id') ?: $this->getRandomPaymentId();

        $user = User::findOrFail($userId);
        $payment = Payment::findOrFail($paymentId);

        $this->info("Enviando confirmación de pago a: {$user->email}");
        $this->notificationService->sendPaymentConfirmation($user, $payment);
        $this->info('✓ Notificación enviada');
    }

    private function testNewOrderAdmin()
    {
        $orderId = $this->option('order-id') ?: $this->getRandomOrderId();
        $order = Order::findOrFail($orderId);

        $adminUsers = User::role(['super-admin', 'admin'])->get();
        
        if ($adminUsers->isEmpty()) {
            $this->error('No hay usuarios admin disponibles');
            return;
        }

        foreach ($adminUsers as $admin) {
            $this->info("Enviando notificación de nuevo pedido a admin: {$admin->email}");
            $this->notificationService->sendNewOrderNotification($admin, $order);
        }
        $this->info('✓ Notificaciones enviadas a todos los admins');
    }

    private function testAll()
    {
        $this->info('Enviando todas las notificaciones de prueba...');
        $this->testOrderConfirmation();
        $this->testOrderStatusUpdate();
        $this->testPaymentConfirmation();
        $this->testNewOrderAdmin();
        $this->info('✓ Todas las notificaciones enviadas');
    }

    private function getRandomUserId(): int
    {
        $user = User::inRandomOrder()->first();
        if (!$user) {
            throw new \Exception('No hay usuarios disponibles en la base de datos');
        }
        return $user->id;
    }

    private function getRandomOrderId(): int
    {
        $order = Order::inRandomOrder()->first();
        if (!$order) {
            throw new \Exception('No hay pedidos disponibles en la base de datos');
        }
        return $order->id;
    }

    private function getRandomPaymentId(): int
    {
        $payment = Payment::inRandomOrder()->first();
        if (!$payment) {
            throw new \Exception('No hay pagos disponibles en la base de datos');
        }
        return $payment->id;
    }
}