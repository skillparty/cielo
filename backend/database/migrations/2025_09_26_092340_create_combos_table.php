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
        Schema::create('combos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')
                ->nullable()
                ->constrained('recipes')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('compare_at_price', 10, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_default_recipe_combo')->default(false);
            $table->unsignedSmallInteger('display_order')->default(0);
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['recipe_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('combos');
    }
};
