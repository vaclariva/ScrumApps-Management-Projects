<?php

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
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
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->foreignIdFor(Province::class)->nullable();
            $table->foreignIdFor(Regency::class)->nullable();
            $table->foreignIdFor(District::class)->nullable();
            $table->string('address')->nullable();
            $table->string('group')->nullable();
            $table->boolean('is_access_product_dev')->nullable();
            $table->bigInteger('credit_limit')->nullable();
            $table->boolean('blocked')->nullable();
            $table->string('password')->nullable();
            $table->boolean('is_weak_password')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
