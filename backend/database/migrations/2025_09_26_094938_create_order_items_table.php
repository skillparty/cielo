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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('combo_id')
                ->nullable()
                ->constrained('combos')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('item_type')->default('product'); // product, combo
            $table->string('name'); // snapshot del nombre al momento del pedido
            $table->text('description')->nullable();
            $table->decimal('quantity', 10, 3);
            $table->string('unit', 30)->default('unidad');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->json('metadata')->nullable(); // snapshot de datos del producto/combo
            $table->timestamps();

            $table->index(['order_id', 'item_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
