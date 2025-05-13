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
        Schema::create('authentication_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('email')->nullable();
            $table->string('remember_me')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('session_id')->nullable();
            $table->string('guard')->nullable();
            $table->text('user_agent')->nullable();
            $table->string('os')->nullable();
            $table->string('duration')->nullable();
            $table->timestamp('login_at')->nullable();
            $table->timestamp('logout_at')->nullable();
            $table->enum('login_status', ['Logged In', 'Failed', 'Logged Out', 'Verification'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authentication_logs');
    }
};
