<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Warehouse;
use App\Models\ProductVariant;
use App\Models\Partner;
use App\Traits\GenerateCodeNumber;

class OrderSeeder extends Seeder
{
    use GenerateCodeNumber;

    public function run()
    {
        $statuses = ['waiting', 'processing', 'completed', 'canceled'];
        $warehouses = Warehouse::all();
        $partners = Partner::all();
        $productVariants = ProductVariant::with('product', 'productVariantPrices')->get();

        foreach ($partners as $partner) {
            foreach ($statuses as $status) {
                $shippingCost = 30000;
                $extraDiscount = 5000;

                $grandTotal = 0;
                $totalProductDiscount = 0;

                $selectedVariant = $productVariants->first();
                $productOrderType = $selectedVariant->product->type;
                $soNumber = $this->generateSONumber();

                foreach ($productVariants->take(2) as $variant) {
                    $variantPrice = $variant->productVariantPrices->first()->price;
                    $productDiscount = 2000;
                    $quantity = 5;

                    $grandTotal += ($variantPrice * $quantity) - $productDiscount;
                    $totalProductDiscount += $productDiscount;

                    DB::table('order_items')->insert([
                        'order_id' => null,
                        'product_variant_id' => $variant->id,
                        'product_name' => $variant->product->name,
                        'product_variant_name' => $variant->name,
                        'product_unit_name' => $variant->unit_name,
                        'product_price' => $variantPrice,
                        'product_discount' => $productDiscount,
                        'quantity' => $quantity,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }

                $grandTotal += $shippingCost - $extraDiscount;

                if ($grandTotal > $partner->credit_limit) {
                    $status = 'waiting';
                }

                $orderId = DB::table('orders')->insertGetId([
                    'user_id' => 1,
                    'warehouse_id' => $warehouses->first()->id,
                    'partner_id' => $partner->id,
                    'partner_name' => $partner->name,
                    'partner_address' => $partner->address,
                    'partner_contact' => $partner->phone_number,
                    'partner_email' => $partner->email,
                    'partner_group' => $partner->group,
                    'so_number' => $soNumber,
                    'product_order_type' => $productOrderType,
                    'business_type' => 'B2B',
                    'shipping_cost' => $shippingCost,
                    'extra_discount' => $extraDiscount,
                    'note' => 'Order note',
                    'grand_total' => $grandTotal,
                    'status' => $status,
                    'ordered_at' => Carbon::now(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                DB::table('order_items')
                    ->where('order_id', null)
                    ->update(['order_id' => $orderId]);

                $paymentStatus = 'unpaid';
                $amount = $grandTotal;

                if ($status === 'completed') {
                    $paymentStatus = 'paid';
                } elseif ($status === 'processing') {
                    $paymentStatus = 'partial';
                    $amount = (int)($grandTotal * 0.7);
                } elseif ($status === 'canceled') {
                    $paymentStatus = 'canceled';
                    $amount = 0;
                }

                DB::table('order_payments')->insert([
                    'order_id' => $orderId,
                    'status' => $paymentStatus,
                    'amount' => $amount,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                $deliveryStatus = 'delayed'; // Default status

                if ($status === 'canceled' || $paymentStatus === 'canceled') {
                    $deliveryStatus = 'canceled';
                } elseif ($paymentStatus === 'paid') {
                    $deliveryStatus = match($status) {
                        'completed' => 'received',
                        'processing' => 'shipped',
                        default => 'packaged',
                    };
                } elseif ($paymentStatus === 'partial') {
                    // Jika dibayar sebagian, masih bisa dikemas
                    $deliveryStatus = 'packaged';
                } elseif ($paymentStatus === 'unpaid') {
                    // Jika belum dibayar, tidak bisa dikemas
                    $deliveryStatus = 'delayed';
                }

                DB::table('order_deliveries')->insert([
                    'order_id' => $orderId,
                    'status' => $deliveryStatus,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
