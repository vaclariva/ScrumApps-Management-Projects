<?php

use App\Models\ProductVariant;
use App\Models\Warehouse;
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
        Schema::create('minimum_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Warehouse::class);
            $table->foreignIdFor(ProductVariant::class);
            $table->decimal('minimum_stock')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('minimum_stocks');
    }
};
