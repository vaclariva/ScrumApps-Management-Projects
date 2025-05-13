<?php

use App\Models\Warehouse;
use App\Models\StockTransaction;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(StockTransaction::class)->nullable()->constrained();
            $table->foreignIdFor(Warehouse::class)->nullable()->constrained();
            $table->foreignIdFor(ProductVariant::class)->nullable()->constrained();
            $table->decimal('begin_stock', 12, 2)->nullable();
            $table->decimal('quantity', 12, 2)->nullable();
            $table->decimal('ending_stock', 12, 2)->nullable();
            $table->enum('in_out_flag', ['in', 'out'])->nullable();
            $table->string('correction')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_histories');
    }
};
