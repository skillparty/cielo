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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->string('payment_method'); // card, qr, cash_on_delivery
            $table->enum('status', [
                'pending',
                'processing',
                'completed',
                'failed',
                'cancelled',
                'refunded',
                'verification_required'
            ])->default('pending');
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('BOB');
            $table->string('gateway_transaction_id')->nullable();
            $table->string('gateway_reference')->nullable();
            $table->text('gateway_response')->nullable();
            $table->string('receipt_file_path')->nullable(); // Para pagos QR
            $table->json('ocr_data')->nullable(); // Datos extraídos por OCR
            $table->enum('verification_status', [
                'pending',
                'auto_approved',
                'manual_review',
                'approved',
                'rejected'
            ])->nullable();
            $table->text('verification_notes')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->foreignId('verified_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['order_id', 'status']);
            $table->index(['payment_method', 'status']);
            $table->index(['verification_status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
