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
        Schema::table('users', function (Blueprint $table) {
            $table->string('google_id')->nullable()->unique()->after('email');
            $table->string('google_token', 1024)->nullable()->after('google_id');
            $table->string('google_refresh_token', 1024)->nullable()->after('google_token');
            $table->string('avatar_url')->nullable()->after('google_refresh_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'google_id',
                'google_token',
                'google_refresh_token',
                'avatar_url',
            ]);
        });
    }
};
