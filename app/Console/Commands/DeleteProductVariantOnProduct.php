<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteProductVariantOnProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:product-variant-on-product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            DB::beginTransaction();
            $products = Product::onlyTrashed()->get();
            foreach ($products as $product) {
                $productVariants = $product->productVariants()->get();
                foreach ($productVariants as $productVariant) {
                    $productVariant->productVariantPrices()->delete();
                    $productVariant->delete();
                }
            }
            $this->info('Berhasil delete productVariant');
            DB::commit();
        } catch (\Throwable $th) {
            info($th);
            DB::rollBack();
        }

    }
}
