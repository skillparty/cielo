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
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('category')->nullable(); // General, Pedidos, Pagos, Envíos, etc.
            $table->string('question');
            $table->text('answer');
            $table->unsignedSmallInteger('display_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();

            $table->index(['category', 'is_published']);
            $table->index(['display_order', 'is_published']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
