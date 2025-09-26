<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->enum('status', [
                'pending',
                'payment_pending',
                'payment_verification',
                'paid',
                'preparing',
                'ready_for_delivery',
                'out_for_delivery',
                'delivered',
                'cancelled',
                'refunded'
            ])->default('pending');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('tax_amount', 10, 2)->default(0);
            $table->decimal('delivery_fee', 10, 2)->default(0);
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->string('currency', 3)->default('BOB');
            $table->enum('payment_method', ['card', 'qr', 'cash_on_delivery'])->nullable();
            $table->string('delivery_address_line1');
            $table->string('delivery_address_line2')->nullable();
            $table->string('delivery_city')->nullable();
            $table->string('delivery_state')->nullable();
            $table->string('delivery_postal_code')->nullable();
            $table->string('delivery_phone');
            $table->text('delivery_notes')->nullable();
            $table->timestamp('estimated_delivery_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index(['status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
