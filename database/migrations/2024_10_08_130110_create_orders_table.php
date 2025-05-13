<?php

use App\Models\Partner;
use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable();
            $table->foreignIdFor(Warehouse::class)->nullable();
            $table->foreignIdFor(Partner::class)->nullable();
            $table->string('partner_name')->nullable();
            $table->string('partner_address')->nullable();
            $table->string('partner_contact')->nullable();
            $table->string('partner_email')->nullable();
            $table->string('partner_group')->nullable();
            $table->string('so_number')->nullable();
            $table->string('product_order_type')->nullable();
            $table->string('business_type')->nullable();
            $table->bigInteger('shipping_cost')->nullable();
            $table->bigInteger('extra_discount')->nullable();
            $table->bigInteger('grand_total')->nullable();
            $table->text('note')->nullable();
            $table->string('status')->nullable();
            $table->text('canceled_reason')->nullable();
            $table->dateTime('ordered_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
