<?php

namespace App\Services;

use App\Models\Stock;
use App\Models\ProductVariant;
use App\Models\StockTransaction;
use Illuminate\Validation\ValidationException;

class StockService
{
    public function updateStockHandling(StockTransaction $stockTransaction, int $productVariantId, float $quantity, ?string $correction, ?string $inOutFlag): void
    {
        $productStock = Stock::where('product_variant_id', $productVariantId)
            ->where('warehouse_id', $stockTransaction->warehouse_id)
            ->lockForUpdate()
            ->first();

        $stock = $productStock ? $productStock->stock : 0;

        if ($inOutFlag == 'out') {
            if ($quantity > $stock) {
                $producVariantName = ProductVariant::find($productVariantId)->product_variant_name;
                throw ValidationException::withMessages([
                    'over' => "Gagal, Stock $producVariantName tidak mencukupi untuk stock out."
                ]);
            }
            $endingStock = $stock - $quantity;

        } else {
            $endingStock = $stock + $quantity;
        }

        //update table stock
        if (! $productStock) {
            Stock::create([
                'warehouse_id' => $stockTransaction->warehouse_id,
                'product_variant_id' => $productVariantId,
                'stock' => $endingStock
            ]);
        } else {
            $productStock->update([
                'stock' => $endingStock
            ]);
        }

        $stockTransaction->stockHistories()->create([
            'warehouse_id' => $stockTransaction->warehouse_id,
            'product_variant_id' => $productVariantId,
            'begin_stock' => $stock,
            'quantity' => $quantity,
            'ending_stock' => $endingStock,
            'in_out_flag' => $inOutFlag,
            'correction' => $correction
        ]);
    }
}
