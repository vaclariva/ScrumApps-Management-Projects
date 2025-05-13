<?php

use App\Models\User;
use App\Models\Warehouse;
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
        Schema::create('stock_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Warehouse::class)->nullable()->constrained();
            $table->foreignIdFor(User::class)->nullable();
            // Define the morphs columns with a custom index name to avoid the too-long identifier error
            $table->nullableMorphs('transactionable', 'stock_transactionable_idx');
            $table->string('type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_transactions');
    }
};
