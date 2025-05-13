<?php

use App\Models\Order;
use App\Models\ProductVariant;
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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)->nullable();
            $table->foreignIdFor(ProductVariant::class)->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_variant_name')->nullable();
            $table->string('product_unit_name')->nullable();
            $table->bigInteger('product_price')->nullable();
            $table->bigInteger('product_discount')->nullable();
            $table->decimal('quantity', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
