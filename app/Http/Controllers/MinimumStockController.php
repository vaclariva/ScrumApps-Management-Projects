<?php

namespace App\Http\Controllers;

use App\Http\Requests\Inventory\UpdateMinimumStockRequest;
use App\Models\MinimumStock;
use App\Models\ProductVariant;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class MinimumStockController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('inventories.minimum-stock', [
                'warehouses'    => Warehouse::get(),
            ]);
        } catch (\Throwable $th) {
            info($th);
            abort(500);
        }
    }

    /**
     * Define datatable instance of minimum stocks.
     */
    public function list(Request $request)
    {
        try {
            $filterWarehouse = $request->warehouse;
            $query = ProductVariant::selectRaw("
                IF(tbr_product_variants.name IS NOT NULL, CONCAT(tbr_products.name, ' - ', tbr_product_variants.name), tbr_products.name) AS variant_name,
                IFNULL(tbr_minimum_stocks.minimum_stock,0) AS minimum_stock,
                tbr_units.name as unit,
                IFNULL(tbr_product_variants.image, tbr_products.feature_image) AS image,
                tbr_minimum_stocks.warehouse_id,
                tbr_product_variants.created_at as variant_created_at,
                tbr_minimum_stocks.updated_at as minimum_stock_updated_at,
                tbr_product_variants.id as product_variant_id
            ")
                ->join('products', 'product_variants.product_id', '=', 'products.id')
                ->leftJoin('minimum_stocks', function ($join) use ($filterWarehouse) {
                    $join->on('product_variants.id', '=', 'minimum_stocks.product_variant_id')
                        ->where('minimum_stocks.warehouse_id', '=', $filterWarehouse);
                })
                ->leftJoin('units', 'product_variants.unit_id', '=', 'units.id')
                ->where('unit_id', '!=', null);
            return DataTables::of(
                $query
            )
                ->addIndexColumn()
                ->editColumn('variant_name', function ($data) {
                    return view('inventories.partials.min-stocks.datatable-name', [
                        'variant_name' => $data['variant_name'],
                        'image' => $data['image'],
                    ]);
                })
                ->editColumn('minimum_stock', function ($stock) use ($filterWarehouse) {
                    return view('inventories.partials.min-stocks.datatable-minimum-stock', [
                        'minimum_stock' => formatNumberId($stock->minimum_stock),
                        'url_update' => route('inventories.minimumStock.update', [$stock->product_variant_id, $filterWarehouse]),
                    ]);
                })
                ->editColumn('unit', function ($stock) {
                    return $stock->unit;
                })
                ->filter(function ($query) use ($request) {
                    $search = $request->input('search')['value'];
                    if ($search) {
                        $query->whereRaw("IF(tbr_product_variants.name is not null, CONCAT(tbr_products.name, ' - ', tbr_product_variants.name) , tbr_products.name ) LIKE ?", ['%' . $search . '%']);
                    }
                })
                ->order(function ($query) use ($request) {
                    $order = $request->input('order')[0];

                    if ($order['column'] == 0) {
                        $query->orderByRaw('minimum_stock = 0 ASC')
                        ->orderByRaw('(CASE WHEN minimum_stock > 0 THEN tbr_minimum_stocks.updated_at END) DESC')
                            ->orderBy('product_variants.created_at', 'DESC')
                            ->orderBy('minimum_stock', 'ASC');
                    } elseif ($order['column'] == 1) {
                        $query->orderBy('variant_name', $order['dir']);
                    } elseif ($order['column'] == 2) {
                        $query->orderBy('minimum_stock', $order['dir']);
                    } elseif ($order['column'] == 3) {
                        $query->orderBy('unit', $order['dir']);
                    }
                })
                ->make(true);
        } catch (\Throwable $th) {
            info($th);

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMinimumStockRequest $request, ProductVariant $productVariant, Warehouse $warehouse)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();

            $validatedData['minimum_stock'] = $validatedData['minimum_stock'] ?? 0;

            $checkVariantAndWarehouse = MinimumStock::where('product_variant_id', $productVariant->id)->where('warehouse_id', $warehouse->id)->first();
            if ($checkVariantAndWarehouse) {
                $checkVariantAndWarehouse->update([
                    'minimum_stock' => $validatedData['minimum_stock'],
                ]);
            } else {
                MinimumStock::create([
                    'warehouse_id' => $warehouse->id,
                    'product_variant_id' => $productVariant->id,
                    'minimum_stock' => $validatedData['minimum_stock'],
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
            ]);
        } catch (\Throwable $th) {
            info($th);
            DB::rollBack();

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }
}
