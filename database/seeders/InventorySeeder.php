<?php

namespace Database\Seeders;

use App\Models\ProductVariant;
use App\Models\StockTransaction;
use App\Models\Warehouse;
use App\Services\StockService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(StockService $stockService): void
    {
        try{

            DB::beginTransaction();
            $warehouses = Warehouse::get();
            $productVariants = ProductVariant::get();

            foreach($warehouses as $warehouse ){
                $stockTransaction = StockTransaction::create([
                    'warehouse_id' => $warehouse->id,
                    'user_id' => 1,
                    'type' => 'Stock In'
                ]);

                foreach($productVariants as $productVariant){
                    $stockService->updateStockHandling($stockTransaction, $productVariant->id, rand(10, 100), null, 'in');
                }

                $stockTransaction = StockTransaction::create([
                    'warehouse_id' => $warehouse->id,
                    'user_id' => 1,
                    'type' => 'Stock In'
                ]);

                foreach($productVariants as $productVariant){
                    $stockService->updateStockHandling($stockTransaction, $productVariant->id, rand(10, 100), null, 'in');
                }

                $stockTransaction = StockTransaction::create([
                    'warehouse_id' => $warehouse->id,
                    'user_id' => 1,
                    'type' => 'Stock In'
                ]);
                foreach($productVariants as $productVariant){
                    $stockService->updateStockHandling($stockTransaction, $productVariant->id, rand(10, 100), null, 'in');
                }

                $stockTransaction = StockTransaction::create([
                    'warehouse_id' => $warehouse->id,
                    'user_id' => 1,
                    'type' => 'Stock In'
                ]);
                foreach($productVariants as $productVariant){
                    $stockService->updateStockHandling($stockTransaction, $productVariant->id, rand(10, 100), null, 'in');
                }


                $stockTransaction = StockTransaction::create([
                    'warehouse_id' => $warehouse->id,
                    'user_id' => 1,
                    'type' => 'Stock Out'
                ]);
                foreach($productVariants as $productVariant){
                    $stockService->updateStockHandling($stockTransaction, $productVariant->id, rand(10, 50), 'Maaf Salah Input Jumlah Stock sebelumnya', 'out');
                }

                $stockTransaction = StockTransaction::create([
                    'warehouse_id' => $warehouse->id,
                    'user_id' => 1,
                    'type' => 'Stock In'
                ]);
                foreach($productVariants as $productVariant){
                    $stockService->updateStockHandling($stockTransaction, $productVariant->id, rand(10, 100), null, 'in');
                }

                $stockTransaction = StockTransaction::create([
                    'warehouse_id' => $warehouse->id,
                    'user_id' => 1,
                    'type' => 'Stock Out'
                ]);
                foreach($productVariants as $productVariant){
                    $stockService->updateStockHandling($stockTransaction, $productVariant->id, rand(10, 50), NULL, 'out');
                }

                $stockTransaction = StockTransaction::create([
                    'warehouse_id' => $warehouse->id,
                    'user_id' => 1,
                    'type' => 'Stock In'
                ]);
                foreach($productVariants as $productVariant){
                    $stockService->updateStockHandling($stockTransaction, $productVariant->id, rand(10, 100), null, 'in');
                }

            }

            DB::commit();
        } catch (\Throwable $th) {
            info($th);
            DB::rollback();
            abort(500);
        }

    }
}
