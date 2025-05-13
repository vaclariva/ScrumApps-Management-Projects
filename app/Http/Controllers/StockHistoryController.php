<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use App\Models\StockHistory;
use App\Models\Warehouse;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StockHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $productVariant = $productVariant = ProductVariant::has('stocks')->select(['product_variants.id'])->selectRaw("IF(tbr_product_variants.name is not null, CONCAT(tbr_products.name, ' - ', tbr_product_variants.name), tbr_products.name) as variant_name")
                ->leftJoin('products', 'product_variants.product_id', '=', 'products.id')->get();
            return view('stock-histories.index', [
                'productVariants' => $productVariant,
                'warehouses' => Warehouse::withTrashed()->get()
            ]);
        } catch (\Throwable $th) {
            info($th);

            abort(500);
        }
    }

    public function list(Request $request)
    {
        try {
            $filterProductVariant = $request->productVariant;
            $filterWarehouse = $request->warehouse;
            $filterStartDate = $request->startDate;
            $filterEndDate = $request->endDate;
            $filterMovementType = $request->movementType;
            info($filterMovementType);
            $filterCorrection = filter_var($request->correction, FILTER_VALIDATE_BOOLEAN);
            $stockHistories = StockHistory::select([
                'stock_histories.created_at as created_at',
                'warehouses.name as warehouse',
                'stock_histories.begin_stock as begin_stock',
                'stock_histories.quantity as quantity',
                'stock_histories.ending_stock as ending_stock',
                'stock_histories.correction as correction',
                'stock_transactions.type as movement_type',
                'users.name as user_name',
            ])
                ->selectRaw("IF(tbr_product_variants.name is not null, CONCAT(tbr_products.name, ' - ', tbr_product_variants.name), tbr_products.name) as product_variant_name")
                ->leftJoin('product_variants', 'stock_histories.product_variant_id', '=', 'product_variants.id')
                ->leftJoin('products', 'product_variants.product_id', '=', 'products.id')
                ->leftJoin('warehouses', 'stock_histories.warehouse_id', '=', 'warehouses.id')
                ->leftJoin('stock_transactions', 'stock_histories.stock_transaction_id', '=', 'stock_transactions.id')
                ->leftJoin('users', 'stock_transactions.user_id', '=', 'users.id')
                ->when(!empty($filterProductVariant), function (Builder $query) use ($filterProductVariant) {
                    $query->whereIn('stock_histories.product_variant_id',  $filterProductVariant);
                })
                ->when(!empty($filterWarehouse), function (Builder $query) use ($filterWarehouse) {
                    $query->whereIn('stock_histories.warehouse_id',  $filterWarehouse);
                })
                ->when(!empty($filterStartDate) && !empty($filterEndDate), function (Builder $query) use ($filterStartDate, $filterEndDate) {
                    $startDate = Carbon::parse($filterStartDate)->startOfDay();
                    $endDate = Carbon::parse($filterEndDate)->endOfDay();
                    $query->whereBetween('stock_histories.created_at', [$startDate, $endDate]);
                })
                ->when(!empty($filterMovementType), function (Builder $query) use ($filterMovementType) {
                    $query->whereIn('stock_transactions.type',  $filterMovementType);
                })
                ->when($filterCorrection === true, function (Builder $query) {
                    $query->whereNotNull('stock_histories.correction');
                });
            return DataTables::of(
                $stockHistories
            )
                ->addIndexColumn()
                ->editColumn('created_at', function ($history) {
                    return $history->created_at->translatedFormat('d F Y, H:i');
                })
                ->addColumn('product_name_variant', function ($history) {
                    return $history->product_variant_name;
                })
                ->addColumn('user_name', function ($history) {
                    return $history->user_name;
                })
                ->addColumn('warehouse', function ($history) {
                    return $history->warehouse;
                })
                ->editColumn('begin_stock', function ($history) {
                    return formatNumberId($history->begin_stock);
                })
                ->editColumn('quantity', function ($history) {
                    return view('stock-histories.partials.listing.datatable-quantity', [
                        'quantity' => formatNumberId($history->quantity),
                        'begin_stock' => formatNumberId($history->begin_stock),
                        'ending_stock' => formatNumberId($history->ending_stock),
                    ]);
                })
                ->editColumn('ending_stock', function ($history) {
                    return formatNumberId($history->ending_stock);
                })
                ->editColumn('movement_type', function ($history) {
                    return view('stock-histories.partials.listing.datatable-movement', ['movement_type' => $history->movement_type, 'correction' => $history->correction]);
                })
                ->editColumn('correction', function ($history) {
                    return $history->correction;
                })
                ->filter(function ($query) use ($request) {
                    $search = $request->input('search')['value'];
                    if ($search) {
                        $query->whereRaw("IF(tbr_product_variants.name is not null, CONCAT(tbr_products.name, ' - ', tbr_product_variants.name) , tbr_products.name ) LIKE ?", ['%' . $search . '%']);
                    }
                })
                ->order(function (Builder $query) use ($request) {
                    $order = $request->input('order')[0];

                    if ($order['column'] == 0) {
                        $query->orderBy('created_at', 'desc')->orderBy('stock_histories.id', 'desc');
                    } elseif ($order['column'] == 1) {
                        $query->orderBy('created_at', $order['dir'])->orderBy('stock_histories.id', $order['dir']);
                    } elseif ($order['column'] == 2) {
                        $query->orderBy('warehouse', $order['dir']);
                    } elseif ($order['column'] == 3) {
                        $query->orderBy('product_variant_name', $order['dir']);
                    } elseif ($order['column'] == 4) {
                        $query->orderBy('begin_stock', $order['dir']);
                    } elseif ($order['column'] == 5) {
                        $query->orderBy('quantity', $order['dir']);
                    } elseif ($order['column'] == 6) {
                        $query->orderBy('ending_stock', $order['dir']);
                    } elseif ($order['column'] == 7) {
                        $query->orderBy('movement_type', $order['dir']);
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
}
