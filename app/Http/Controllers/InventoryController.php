<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Category;
use App\Models\Warehouse;
use App\Models\ProductVariant;
use App\Services\StockService;
use App\Http\Requests\Inventory\StoreInventoryRequest;
use App\Models\StockTransaction;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $productVariantStock = ProductVariant::has('stocks')
                ->select('product_variants.id', 'product_variants.name', 'products.name as product_name')
                ->join('products', 'product_variants.product_id', '=', 'products.id')
                ->get();

            return view('inventories.index', [
                'warehouses'    => Warehouse::get(),
                'categories'    => Category::get(),
                'listProducts'  => $productVariantStock
            ]);
        } catch (\Throwable $th) {
            info($th);
            abort(500);
        }
    }

    /**
     * Define datatable instance of users.
     */
    public function list(Request $request)
    {
        try {

            $filterWarehouse = $request->warehouse;
            $filterStatus = $request->status;

            return DataTables::of(
                Stock::selectRaw("tbr_units.name as unit_name, tbr_warehouses.name as warehouse_name,
                    IFNULL(tbr_product_variants.image, tbr_products.feature_image) as product_image,
                    IF(tbr_product_variants.name is not null, CONCAT(tbr_products.name, ' - ', tbr_product_variants.name), tbr_products.name) as product_variant_name,
                    tbr_stocks.stock, tbr_stocks.updated_at,
                    CASE
                        WHEN tbr_stocks.stock <= 0 THEN 'Out Of Stock'
                        WHEN tbr_stocks.stock <= IFNULL(tbr_minimum_stocks.minimum_stock, 0)  THEN 'Low'
                        ELSE 'Available'
                    END AS status
                    ")
                    ->join('product_variants', 'stocks.product_variant_id', '=', 'product_variants.id')
                    ->join('products', 'product_variants.product_id', '=', 'products.id')
                    ->join('units', 'product_variants.unit_id', '=', 'units.id')
                    ->join('warehouses', 'stocks.warehouse_id', '=', 'warehouses.id')
                    ->leftJoin('minimum_stocks', function ($join) {
                        $join->on('stocks.product_variant_id', '=', 'minimum_stocks.product_variant_id')
                            ->on('stocks.warehouse_id', '=', 'minimum_stocks.warehouse_id');
                    })
                    ->whereNull('warehouses.deleted_at')
                    ->whereNull('product_variants.deleted_at')
                    ->when(!empty($filterStatus), function (Builder $query) use ($filterStatus) {
                        $query->havingRaw('status IN (' . implode(',', array_fill(0, count($filterStatus), '?')) . ')', $filterStatus);
                    })
                    ->when(!empty($filterWarehouse), function (Builder $query) use ($filterWarehouse) {
                        $query->whereIn('stocks.warehouse_id',  $filterWarehouse);
                    })
            )
                ->addIndexColumn()
                ->editColumn('product_variant_name', function (Stock $stock) {
                    $defaultFoto = asset('assets/images/gallery.png');
                    return view('inventories.partials.datatable-name', [
                        'product_variant_name' => $stock->product_variant_name,
                        'product_image' => $stock->product_image ? (Storage::disk('public')->exists($stock->product_image) ? Storage::url($stock->product_image) : $defaultFoto) : $defaultFoto
                    ]);
                })
                ->editColumn('product_image', function (Stock $stock) {
                    $defaultFoto = null;
                    return $stock->product_image ? (Storage::disk('public')->exists($stock->product_image) ? Storage::url($stock->product_image) : $defaultFoto) : $defaultFoto;
                })
                ->editColumn('stock', fn(Stock $stock) => formatNumberId($stock->stock))
                ->editColumn('status', fn(Stock $stock) => view('inventories.partials.datatable-status', ['status' => $stock->status]))
                ->editColumn('warehouse_name', fn(Stock $stock) => $stock->warehouse_name)
                ->editColumn('updated_at', fn(Stock $stock) => $stock->updated_at->translatedFormat('d F Y H:i'))
                ->filter(function ($query) use ($request) {
                    $search = $request->input('search')['value'];
                    if ($search) {
                        $query->whereRaw("IF(tbr_product_variants.name is not null, CONCAT(tbr_products.name, ' - ', tbr_product_variants.name) , tbr_products.name ) LIKE ?", ['%' . $search . '%']);
                    }
                })
                ->order(function (Builder $query) use ($request) {
                    $order = $request->input('order')[0];

                    if ($order['column'] == 0) {
                        $query->orderBy('updated_at', 'desc');
                    } elseif ($order['column'] == 1) {
                        $query->orderBy('product_variant_name', $order['dir']);
                    } elseif ($order['column'] == 2) {
                        $query->orderBy('stock', $order['dir']);
                    } elseif ($order['column'] == 3) {
                        $query->orderBy('unit_name', $order['dir']);
                    } elseif ($order['column'] == 4) {
                        $query->orderBy('warehouse_name', $order['dir']);
                    } elseif ($order['column'] == 5) {
                        $query->orderBy('status', $order['dir']);
                    } elseif ($order['column'] == 6) {
                        $query->orderBy('updated_at', $order['dir']);
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
     * Display a listing of the resource.
     */
    public function create(Request $request, string $type)
    {
        if (!in_array($type, ['stock-in', 'stock-out'])) {
            abort(404);
        }

        try {

            $productVariantStock = ProductVariant::select(
                'product_variants.id',
                'product_variants.name',
                'products.name as product_name',
                'units.id as unit_id',
                'units.name as unit_name'
            )
                ->when($type == 'stock-out', function ($query) {
                    $query->has('stocks');
                })
                ->join('products', 'product_variants.product_id', '=', 'products.id')
                ->leftJoin('units', 'product_variants.unit_id', '=', 'units.id')
                ->get();

            return view($type == 'stock-in' ? 'inventories.stock-in' : 'inventories.stock-out', [
                'warehouses'    => Warehouse::get(),
                'productVariants'  => $productVariantStock
            ]);
        } catch (\Throwable $th) {
            info($th);
            abort(500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInventoryRequest $request, StockService $stockService)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validated();

            $transaction = StockTransaction::create([
                'warehouse_id' => $validated['warehouse_id'],
                'user_id' => auth()->user()->id,
                'type' => $validated['type']
            ]);

            $inOutFlag = '';
            if ($validated['type'] == 'Stock In') {
                $inOutFlag = 'in';
            } else if ($validated['type'] == 'Stock Out') {
                $inOutFlag = 'out';
            }

            foreach ($validated['product_variant_id'] as $key => $productVariantId) {
                $stockService->updateStockHandling($transaction, $productVariantId, $validated['quantity'][$key], $validated['correction'][$key], $inOutFlag);
            }

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
                'redirect' => route('inventories.index'),
            ]);
        } catch (ValidationException $e) {
            info($e);
            DB::rollBack();
            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        } catch (\Throwable $th) {
            info($th);
            DB::rollBack();
            return response()->json([
                'message' => 'Gagal disimpan.',
            ], 500);
        }
    }

    /**
     * Define function for check stock.
     */
    public function checkStockProductVariant(Request $request, ProductVariant $productVariant): JsonResponse
    {

        try {
            if (!$request->warehouse_id) {
                return response()->json([
                    'message' => 'Silahkan pilih lokasi terlebih dahulu.',
                ], 500);
            } elseif (!$warehouse = Warehouse::find($request->warehouse_id)) {
                return response()->json([
                    'message' => trans('http-statuses.404'),
                ], 404);
            }

            $productVariant->append(['product_variant_name', 'unit_name']);
            $productVariant->stock = $productVariant->getWarehouseStock($warehouse->id);

            return response()->json([
                'productVariant' => $productVariant
            ]);
        } catch (\Throwable $th) {
            info($th);

            return response()->json([
                'message' => 'Gagal mendapatkan data stock.',
            ], 500);
        }
    }
}
