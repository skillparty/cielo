<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Category;
use App\Models\Product;
use App\Services\NotificationService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class NotificationTestSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🔔 Creando datos de prueba para notificaciones...');

        // Crear usuario de prueba si no existe
        $testUser = User::firstOrCreate([
            'email' => 'test@cielo.com'
        ], [
            'name' => 'Usuario Test',
            'phone' => '+1234567890',
            'address_line1' => '123 Test Street',
            'city' => 'Test City',
            'state' => 'Test State',
            'postal_code' => '12345',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'accepted_terms_at' => now(),
        ]);

        // Crear admin de prueba si no existe
        $adminUser = User::firstOrCreate([
            'email' => 'admin@cielo.com'
        ], [
            'name' => 'Admin Test',
            'phone' => '+1234567891',
            'address_line1' => '456 Admin Street',
            'city' => 'Admin City',
            'state' => 'Admin State',
            'postal_code' => '54321',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'accepted_terms_at' => now(),
        ]);

        // Asignar rol de admin
        if (!$adminUser->hasRole('admin')) {
            $adminUser->assignRole('admin');
        }

        // Crear categoría de prueba
        $category = Category::firstOrCreate([
            'name' => 'Test Category'
        ], [
            'slug' => 'test-category',
            'description' => 'Categoría de prueba para notificaciones',
            'is_active' => true,
        ]);

        // Crear producto de prueba
        $product = Product::firstOrCreate([
            'name' => 'Producto Test'
        ], [
            'sku' => 'TEST-001',
            'slug' => 'producto-test',
            'description' => 'Producto de prueba para notificaciones',
            'base_price' => 25.99,
            'unit_type' => 'piece',
            'unit_quantity' => 1,
            'category_id' => $category->id,
            'is_active' => true,
            'stock' => 100,
        ]);

        // Crear pedido de prueba
        $order = Order::create([
            'user_id' => $testUser->id,
            'status' => 'pending',
            'total' => 25.99,
            'subtotal' => 25.99,
            'tax_amount' => 0,
            'delivery_fee' => 0,
            'discount_amount' => 0,
            'currency' => 'USD',
            'payment_method' => 'card',
            'delivery_address_line1' => '123 Test Street',
            'delivery_city' => 'Test City',
            'delivery_state' => 'Test State',
            'delivery_postal_code' => '12345',
            'delivery_phone' => '+1234567890',
        ]);

        // Crear pago de prueba
        $payment = Payment::create([
            'order_id' => $order->id,
            'payment_method' => 'card',
            'status' => 'pending',
            'amount' => 25.99,
            'currency' => 'USD',
            'gateway_transaction_id' => 'test_txn_' . uniqid(),
        ]);

        $this->command->info('✅ Datos de prueba creados:');
        $this->command->line("  - Usuario: {$testUser->email} (ID: {$testUser->id})");
        $this->command->line("  - Admin: {$adminUser->email} (ID: {$adminUser->id})");
        $this->command->line("  - Pedido: #{$order->order_number} (ID: {$order->id})");
        $this->command->line("  - Pago: {$payment->gateway_transaction_id} (ID: {$payment->id})");

        // Probar notificaciones si está habilitado
        if ($this->command->confirm('¿Deseas probar las notificaciones ahora?', true)) {
            $this->testNotifications($testUser, $adminUser, $order, $payment);
        }
    }

    private function testNotifications(User $testUser, User $adminUser, Order $order, Payment $payment): void
    {
        $notificationService = app(NotificationService::class);

        $this->command->info('🧪 Probando sistema de notificaciones...');

        try {
            // 1. Test order confirmation
            $this->command->line('📧 Enviando confirmación de pedido...');
            $result = $notificationService->sendOrderConfirmation($order);
            $this->command->line($result ? '✅ Enviado' : '❌ Error');

            // 2. Test order status update
            $this->command->line('📧 Enviando actualización de estado...');
            $result = $notificationService->sendOrderStatusUpdate($order, 'pending');
            $this->command->line($result ? '✅ Enviado' : '❌ Error');

            // 3. Test payment confirmation
            $this->command->line('📧 Enviando confirmación de pago...');
            $result = $notificationService->sendPaymentConfirmation($payment);
            $this->command->line($result ? '✅ Enviado' : '❌ Error');

            // 4. Test admin notification
            $this->command->line('📧 Enviando notificación de admin...');
            $result = $notificationService->sendNewOrderNotification($order);
            $this->command->line($result ? '✅ Enviado' : '❌ Error');

            $this->command->info('✅ Pruebas de notificación completadas');
            $this->command->line('');
            $this->command->info('💡 Para procesar la cola de emails, ejecuta:');
            $this->command->line('php artisan queue:work --queue=emails');
            $this->command->line('');
            $this->command->info('💡 Para ver los logs:');
            $this->command->line('tail -f storage/logs/laravel.log');

        } catch (\Exception $e) {
            $this->command->error('❌ Error al probar notificaciones: ' . $e->getMessage());
            Log::error('Error en NotificationTestSeeder', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
}