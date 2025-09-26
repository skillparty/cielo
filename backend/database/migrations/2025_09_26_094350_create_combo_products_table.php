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
        Schema::create('combo_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('combo_id')
                ->constrained('combos')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->decimal('quantity', 10, 3)->default(1);
            $table->string('unit', 30)->default('unidad');
            $table->decimal('unit_price_override', 10, 2)->nullable();
            $table->unsignedSmallInteger('display_order')->default(0);
            $table->boolean('is_optional')->default(false);
            $table->timestamps();

            $table->unique(['combo_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('combo_products');
    }
};
