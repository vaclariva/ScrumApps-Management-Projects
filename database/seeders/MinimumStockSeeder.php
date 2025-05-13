<?php

namespace Database\Seeders;

use App\Models\MinimumStock;
use App\Models\ProductVariant;
use App\Models\Stock;
use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MinimumStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $warehouses = Warehouse::get();
        $productVariants = ProductVariant::limit(10)->get();

        foreach($warehouses as $warehouse ){
            foreach($productVariants as $productVariant) {
                MinimumStock::create([
                    'warehouse_id' => $warehouse->id,
                    'product_variant_id' => $productVariant->id,
                    'minimum_stock' => rand(0, 20),
                ]);
            }
        }
    }
}
