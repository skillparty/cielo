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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->string('sku')->unique();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->text('preparation_tips')->nullable();
            $table->decimal('base_price', 10, 2);
            $table->decimal('promo_price', 10, 2)->nullable();
            $table->string('unit_type', 30)->default('kg');
            $table->decimal('unit_quantity', 8, 3)->default(1);
            $table->decimal('stock', 10, 3)->default(0);
            $table->decimal('safety_stock', 10, 3)->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->json('nutrition_facts')->nullable();
            $table->json('metadata')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['category_id', 'is_active']);
            $table->index(['is_featured', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
