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
        Schema::create('recipe_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')
                ->constrained('recipes')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->decimal('quantity', 10, 3)->default(1);
            $table->string('unit', 30)->default('unidad'); // gr, kg, paquete, etc.
            $table->boolean('is_optional')->default(false);
            $table->unsignedSmallInteger('display_order')->default(0);
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->unique(['recipe_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipe_products');
    }
};
