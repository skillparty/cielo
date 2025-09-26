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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('summary')->nullable();
            $table->longText('instructions');
            $table->unsignedSmallInteger('prep_time_minutes')->default(0);
            $table->unsignedSmallInteger('cook_time_minutes')->default(0);
            $table->unsignedTinyInteger('difficulty_level')->default(1); // 1: Fácil, 2: Media, 3: Difícil
            $table->unsignedTinyInteger('servings')->default(1);
            $table->string('video_url')->nullable();
            $table->string('cover_image')->nullable();
            $table->json('nutrition_facts')->nullable();
            $table->json('metadata')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['category_id', 'is_published']);
            $table->index(['difficulty_level', 'is_published']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
