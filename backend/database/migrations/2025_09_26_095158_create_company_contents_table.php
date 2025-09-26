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
        Schema::create('company_contents', function (Blueprint $table) {
            $table->id();
            $table->string('section_key')->unique(); // hero, history, values, locations, etc.
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->longText('content')->nullable();
            $table->json('gallery_images')->nullable(); // Array de rutas de imágenes
            $table->string('video_url')->nullable();
            $table->json('location_data')->nullable(); // Coordenadas, dirección, etc.
            $table->unsignedSmallInteger('display_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['section_key', 'is_published']);
            $table->index(['display_order', 'is_published']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_contents');
    }
};
