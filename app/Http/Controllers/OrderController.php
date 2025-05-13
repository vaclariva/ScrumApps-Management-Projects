<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDelivery;
use App\Models\OrderItem;
use App\Models\Partner;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Stock;
use App\Models\StockTransaction;
use App\Models\Warehouse;
use App\Services\StockService;
use App\Traits\GenerateCodeNumber;
use Dflydev\DotAccessData\Data;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Yajra\DataTables\Contracts\DataTable;

class OrderController extends Controller
{

    /**
     * Define Trait
     */
    use GenerateCodeNumber;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('orders.index');
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
            $filterStartDate = $request->startDate;
            $filterEndDate = $request->endDate;
            $filterType = $request->type;
            $filterPayment = $request->payment;
            $filterDelivery = $request->delivery;
            $filterStatus = $request->status;
            $data = Order::select([
                'orders.id',
                'orders.so_number',
                'orders.partner_name',
                'orders.product_order_type',
                'orders.partner_group',
                'orders.grand_total',
                'order_payments.status as payment',
                'order_deliveries.status as delivery',
                'orders.status',
                'users.name as user_name',
                'orders.ordered_at',
                'orders.updated_at',
            ])
                ->leftJoin('partners', 'orders.partner_id', '=', 'partners.id')
                ->leftJoin('users', 'orders.user_id', '=', 'users.id')
                ->leftJoin('order_deliveries', 'orders.id', '=', 'order_deliveries.order_id')
                ->leftJoin('order_payments', 'orders.id', '=', 'order_payments.order_id')
                ->when(!empty($filterStartDate) && !empty($filterEndDate), function (Builder $query) use ($filterStartDate, $filterEndDate) {
                    $startDate = Carbon::parse($filterStartDate)->startOfDay();
                    $endDate = Carbon::parse($filterEndDate)->endOfDay();
                    $query->whereBetween('orders.created_at', [$startDate, $endDate]);
                })
                ->when(!empty($filterPayment), function (Builder $query) use ($filterPayment) {
                    $query->whereIn('order_payments.status', $filterPayment);
                })
                ->when(!empty($filterPayment), function (Builder $query) use ($filterPayment) {
                    $query->whereIn('order_payments.status', $filterPayment);
                })
                ->when(!empty($filterType), function (Builder $query) use ($filterType) {
                    $query->whereIn('orders.product_order_type', $filterType);
                })
                ->when(!empty($filterDelivery), function (Builder $query) use ($filterDelivery) {
                    $query->whereIn('order_deliveries.status', $filterDelivery);
                })
                ->when(!empty($filterStatus), function (Builder $query) use ($filterStatus) {
                    $query->whereIn('orders.status', $filterStatus);
                });

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('so_number', function ($data) {
                    return view('orders.partials.datatable-so-number', ['so_number' => $data['so_number'], 'business_type' => $data['business_type'], 'partner_group' => $data['partner_group'], 'url_edit' => route('orders.edit', $data['id'])]);
                })
                ->editColumn('payment', function ($data) {
                    return view('orders.partials.datatable-payment', ['payment' => $data['payment']]);
                })
                ->editColumn('delivery', function ($data) {
                    return view('orders.partials.datatable-delivery', ['delivery' => $data['delivery']]);
                })
                ->editColumn('status', function ($data) {
                    return view('orders.partials.datatable-status', ['status' => $data['status']]);
                })
                ->addColumn('actions', function ($data) {
                    return view('orders.partials.datatable-actions', ['url_delete' => '']);
                })
                ->editColumn('ordered_at', function ($data) {
                    return \Carbon\Carbon::parse($data['ordered_at'])->translatedFormat('d F Y, H:i');
                })
                ->editColumn('updated_at', function ($data) {
                    return \Carbon\Carbon::parse($data['updated_at'])->translatedFormat('d F Y, H:i');
                })
                ->editColumn('grand_total', function ($data) {
                    return rupiah($data['grand_total']);
                })
                ->filter(function ($query) use ($request) {
                    $search = $request->input('search')['value'];
                    if ($search) {
                        $query->where('partners.name', 'LIKE', '%' . $search . '%');
                    }
                })
                ->order(function (Builder $query) use ($request) {
                    $order = $request->input('order')[0];

                    if ($order['column'] == 0) {
                        $query->orderByRaw('GREATEST(tbr_orders.ordered_at, tbr_orders.updated_at) DESC');
                    } elseif ($order['column'] == 1) {
                        $query->orderBy('orders.so_number', $order['dir']);
                    } elseif ($order['column'] == 2) {
                        $query->orderBy('orders.partner_name', $order['dir']);
                    } elseif ($order['column'] == 3) {
                        $query->orderBy('orders.product_order_type', $order['dir']);
                    } elseif ($order['column'] == 4) {
                        $query->orderBy('orders.grand_total', $order['dir']);
                    } elseif ($order['column'] == 5) {
                        $query->orderBy('order_payments.status', $order['dir']);
                    } elseif ($order['column'] == 6) {
                        $query->orderBy('order_deliveries.status', $order['dir']);
                    } elseif ($order['column'] == 7) {
                        $query->orderBy('orders.status', $order['dir']);
                    } elseif ($order['column'] == 8) {
                        $query->orderBy('users.name', $order['dir']);
                    } elseif ($order['column'] == 9) {
                        $query->orderBy('orders.ordered_at', $order['dir']);
                    } elseif ($order['column'] == 10) {
                        $query->orderBy('orders.updated_at', $order['dir']);
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

    public function widget(Request $request)
    {
        $filterStartDate = $request->startDate;
        $filterEndDate = $request->endDate;
        $filterType = $request->type;
        $filterPayment = $request->payment;
        $filterDelivery = $request->delivery;
        $filterStatus = $request->status;
        $search = $request->search;

        $order = Order::selectRaw('count(tbr_orders.id) as total_order,
                sum(IF(tbr_orders.status = "processing", 1, 0)) as total_order_processing,
                sum(IF(tbr_order_deliveries.status = "delayed", 1, 0)) as total_order_packaged,
                sum(IF(tbr_order_payments.status = "paid" or tbr_order_payments.status = "partial", 1, 0)) as total_payment_waiting,
                sum(tbr_orders.grand_total) as order_grand_total')
            ->leftJoin('order_deliveries', 'orders.id', '=', 'order_deliveries.order_id')
            ->leftJoin('order_payments', 'orders.id', '=', 'order_payments.order_id')
            ->when(!empty($filterStartDate) && !empty($filterEndDate), function (Builder $query) use ($filterStartDate, $filterEndDate) {
                $startDate = Carbon::parse($filterStartDate)->startOfDay();
                $endDate = Carbon::parse($filterEndDate)->endOfDay();
                $query->whereBetween('orders.created_at', [$startDate, $endDate]);
            })
            ->when(!empty($filterPayment), function (Builder $query) use ($filterPayment) {
                $query->whereIn('order_payments.status', $filterPayment);
            })
            ->when(!empty($filterPayment), function (Builder $query) use ($filterPayment) {
                $query->whereIn('order_payments.status', $filterPayment);
            })
            ->when(!empty($filterType), function (Builder $query) use ($filterType) {
                $query->whereIn('orders.product_order_type', $filterType);
            })
            ->when(!empty($filterDelivery), function (Builder $query) use ($filterDelivery) {
                $query->whereIn('order_deliveries.status', $filterDelivery);
            })
            ->when(!empty($filterStatus), function (Builder $query) use ($filterStatus) {
                $query->whereIn('orders.status', $filterStatus);
            })
            ->when(!empty($search), function (Builder $query) use ($search) {
                $query->where('orders.partner_name', 'LIKE', '%' . $search . '%');
            })
            ->first();

        return response()->json($order);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $partners = Partner::select([
                'partners.*',
                'provinces.name as province',
                'regencies.name as regency',
                'districts.name as district',
                DB::raw('tbr_partners.credit_limit - SUM(IF(tbr_order_payments.status != "paid", tbr_orders.grand_total - IFNULL(tbr_order_payments.amount, 0), 0)) as remaining_credit'),
                DB::raw('SUM(IF(tbr_order_payments.status != "paid", tbr_orders.grand_total - IFNULL(tbr_order_payments.amount, 0), 0)) as unpaid_orders')
            ])
                ->leftJoin('provinces', 'partners.province_id', '=', 'provinces.id')
                ->leftJoin('regencies', 'partners.regency_id', '=', 'regencies.id')
                ->leftJoin('districts', 'partners.district_id', '=', 'districts.id')
                ->leftJoin('orders', 'partners.id', '=', 'orders.partner_id')
                ->leftJoin('order_payments', 'orders.id', '=', 'order_payments.order_id')
                ->groupBy('partners.id', 'partners.name', 'partners.credit_limit', 'provinces.name', 'districts.name')
                ->get();

            $order = Order::where('status', 'waiting')
                ->where('user_id', auth()->user()->id)
                ->orderBy('created_at', 'desc')
                ->first();
            if ($order) {
                return view('orders.create', [
                    'order' => $order,
                    'warehouses' => Warehouse::get(),
                    'partners' => $partners,
                    'category_id' => Category::all(),
                    'orderDelivery' => OrderDelivery::where('order_id', $order->id)->first(),
                    'categories' => Category::all()
                ]);
            } else {
                $soNumber = $this->generateSoNumber();
                $order = Order::create([
                    'so_number' => $soNumber,
                    'status' => 'waiting',
                    'business_type' => 'b2b',
                    'user_id' => auth()->user()->id,
                    'product_order_type' => 'Popular',
                ]);
                $order = Order::find($order->id);
                return view('orders.create', [
                    'order' => $order,
                    'warehouses' => Warehouse::get(),
                    'partners' => $partners,
                    'category_id' => Category::all(),
                    'orderDelivery' => OrderDelivery::where('order_id', $order->id)->first(),
                    'categories' => Category::all()
                ]);
            }
        } catch (\Throwable $th) {
            info($th);

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, StockService $stockService)
    {
        try {
            DB::beginTransaction();

            $orderId = $request->order_id;
            $order = Order::find($orderId);

            $stockTransaction = $order->stockTransaction()->create([
                'warehouse_id' => $request->warehouse_id,
                'user_id' => auth()->user()->id,
                'type' => 'Sale'
            ]);

            foreach ($order->orderItems as $orderItem) {
                $stockService->updateStockHandling($stockTransaction, $orderItem->product_variant_id, $orderItem->quantity, null, 'out');
            }

            $order->update([
                'status' => 'waiting',
                'ordered_at' => Carbon::now()->setTimezone('Asia/Jakarta'),
            ]);

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
            ]);
        } catch (\Throwable $th) {
            info($th);

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        try {
            // $order
            $orderDelivery =  OrderDelivery::where('order_id', $order->id)->first();
            return view('orders.edit', ['order' => $order, 'orderDelivery' => $orderDelivery]);
        } catch (\Throwable $th) {
            info($th);

            abort(500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        try {
            DB::beginTransaction();

            // foreach ($order->orderItems as $orderItem) {
            //     $orderItem
            // }

            DB::commit();
        } catch (\Throwable $th) {
            info($th);

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }

    /**
     * Update Partial Data
     */
    public function updatePartial(Request $request, Order $order)
    {
        try {
            DB::beginTransaction();
            $order->update([
                'extra_discount' => $request->discount ? str_replace('.', '', $request->discount) : 0,
                'shipping_cost' => $request->shipping_cost ? str_replace('.', '', $request->shipping_cost) : 0,
                'note' => $request->note,
            ]);

            $orderDelivery = OrderDelivery::updateOrCreate(
                ['order_id' => $order->id],
                ['shipping_address' => $request->shipping_address]
            );

            if ($request->has('partner_id')) {
                if (!empty($request->partner_id)) {
                    $partner = Partner::find($request->partner_id);
                    $order->update([
                        'partner_id' => $request->partner_id,
                        'partner_name' => $partner->name,
                        'partner_address' => $partner->address,
                        'partner_contact' => $partner->phone_number,
                        'partner_email' => $partner->email,
                        'partner_group' => $partner->group,
                    ]);
                }
            }

            if ($request->has('warehouse_id')) {
                $order->update(['warehouse_id' => $request->warehouse_id]);
            }

            $orderItems = $order->orderItems;
            $grandTotal = 0;

            foreach ($orderItems as $item) {
                $price = $item->product_price;
                $quantity = $item->quantity;
                $discount = $item->product_discount ?? 0;

                $grandTotal += ($price * $quantity) - $discount;
            }

            $grandTotal -= $order->extra_discount;
            $grandTotal += $order->shipping_cost;

            $grandTotal = max($grandTotal, 0);

            $order->update(['grand_total' => $grandTotal]);

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
            ]);
        } catch (\Throwable $th) {
            info($th);

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, StockService $stockService, Order $order)
    {
        try {
            DB::beginTransaction();

            $orderItems = $order->orderItems;
            if ($orderItems) {
                // Cancel when in Detail Order
                if ($request->has('canceled_reason')) {
                    $stockTransaction = $order->stockTransactions()->create([
                        'warehouse_id' => $request->warehouse_id,
                        'user_id' => auth()->user()->id,
                        'type' => 'Sale'
                    ]);

                    $correction = 'Pesanan dibatalkan oleh ' . auth()->user()->role . ' bernama ' . auth()->user()->name;

                    foreach ($orderItems as $orderItem) {
                        $stockService->updateStockHandling($stockTransaction, $orderItem->product_variant_id, $orderItem->quantity, $correction, 'in');
                    }
                }

                foreach ($orderItems as $item) {
                    $item->delete();
                }
            }

            if ($request->has('canceled_reason')) {
                // Cancel when in Detail Order
                $order->update([
                    'canceled_reason' => $request->canceled_reason,
                    'status' => 'canceled',
                ]);
            } else {
                $order->delete();
            }

            DB::commit();

            return response()->json([
                'message' => trans('Berhasil dihapus.'),
            ]);
        } catch (\Throwable $th) {
            info($th);

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }

    /**
     * Get the Product List data for the order
     */
    public function getProductList(Request $request)
    {
        try {
            $partner = Partner::where('id', $request->partner_id)->first();
            $filterCategory = $request->category_id;
            $filterType = $request->type;
            $product = ProductVariant::select([
                'product_variants.id',
                DB::raw("IF(tbr_product_variants.name is not null, CONCAT(tbr_products.name, ' - ', tbr_product_variants.name), tbr_products.name) as variant_name"),
                'stocks.stock',
                'units.name as unit',
                'categories.name as category',
                'product_variant_prices.price as price',
                'product_variant_prices.star_price as star_price',
                DB::raw("IF((SELECT COUNT(*) FROM tbr_order_items WHERE tbr_order_items.product_variant_id = tbr_product_variants.id AND tbr_order_items.order_id = {$request->order_id}) > 0, true, false) AS is_on_order"),

            ])
                ->leftJoin('stocks', 'product_variants.id', '=', 'stocks.product_variant_id')
                ->leftJoin('units', 'product_variants.unit_id', '=', 'units.id')
                ->leftJoin('products', 'product_variants.product_id', '=', 'products.id')
                ->leftJoin('product_categories', 'products.id', '=', 'product_categories.product_id')
                ->leftJoin('categories', 'product_categories.category_id', '=', 'categories.id')
                ->leftJoin('product_variant_prices', 'product_variants.id', '=', 'product_variant_prices.product_variant_id')
                ->where('stocks.stock', '>', 0)
                ->where('product_variant_prices.is_visible', '1')
                ->where('product_variant_prices.business_model', 'b2b')
                ->where('stocks.warehouse_id', $request->warehouse_id)
                ->when(!empty($filterCategory), function (Builder $query) use ($filterCategory) {
                    $query->where('categories.id', $filterCategory);
                })
                ->when(!empty($filterType), function (Builder $query) use ($filterType) {
                    $query->where('products.type', $filterType);
                });
                // return response()->json($product->get());
            return DataTables::of($product)
                ->addIndexColumn()
                ->editColumn('variant_name', function ($data) {
                    return $data['variant_name'];
                })
                ->editColumn('stock', function ($data) {
                    return $data['stock'];
                })
                ->editColumn('price', function ($data) use ($partner) {
                    $price = $partner->group == 'star' ? $data['star_price'] : $data['price'];
                    return rupiah($price);
                })
                ->editColumn('unit', function ($data) {
                    return $data['unit'];
                })
                ->editColumn('category', function ($data) {
                    return $data['category'];
                })
                ->addColumn('actions', function ($data) {
                    return view('orders.partials.create.datatable-actions', ['productVariantId' => $data['id'], 'stock' => $data['stock'], 'is_on_order' => $data['is_on_order']]);
                })
                ->filter(function ($query) use ($request) {
                    $search = $request->input('search')['value'];
                    if ($search) {
                        $query->whereRaw("IF(tbr_product_variants.name is not null, CONCAT(tbr_products.name, ' - ', tbr_product_variants.name) , tbr_products.name ) LIKE ?", ['%' . $search . '%']);
                    }
                })
                ->make(true);
        } catch (\Throwable $th) {
            info($th);

            abort(500);
        }
    }

    /**
     * Get Product order list
     */
    public function getOrderProduct(Request $request)
    {
        try {
            $order = Order::find($request->order_id);
            $orderItems = ProductVariant::select([
                'order_items.id',
                'order_items.product_variant_id',
                'product_variants.image',
                'products.name as product_name',
                'product_variants.name as variant_name',
                'order_items.quantity',
                'order_items.product_discount',
                'product_variant_prices.price as _normal_price',
                'product_variant_prices.star_price as _star_price',
                DB::raw("CAST(tbr_stocks.stock AS UNSIGNED) as product_stock"),
                DB::raw("IF(tbr_order_items.quantity > tbr_stocks.stock, true, false) as is_over"),
                DB::raw("IF(tbr_partners.group = 'star', tbr_product_variant_prices.star_price, tbr_product_variant_prices.price) as price"),
            ])
                ->leftJoin('order_items', 'product_variants.id', '=', 'order_items.product_variant_id')
                ->leftJoin('product_variant_prices', 'product_variants.id', '=', 'product_variant_prices.product_variant_id')
                ->leftJoin('products', 'product_variants.product_id', '=', 'products.id')
                ->leftJoin('stocks', function ($join) use ($order) {
                    $join->on('product_variants.id', '=', 'stocks.product_variant_id')
                        ->where('stocks.warehouse_id', '=', $order->warehouse_id);
                })
                ->leftJoin('orders', 'orders.id', '=', 'order_items.order_id')
                ->leftJoin('partners', 'partners.id', '=', 'orders.partner_id')
                ->where('order_items.order_id', $order->id)
                ->where('product_variant_prices.business_model', 'b2b')->get();
            foreach ($orderItems as $orderItem) {
                $orderItem->url_delete = route('orders.deleteProduct', $orderItem->id);
            }

            return response()->json($orderItems);
        } catch (\Throwable $th) {
            info($th);

            abort(500);
        }
    }

    /**
     * Store Order Item
     */
    public function addProduct(Request $request)
    {
        try {
            DB::beginTransaction();

            $partner = Partner::find($request->partner_id);
            $product = ProductVariant::select([
                'product_variants.id',
                'products.name as product_name',
                'product_variants.name as variant_name',
                'units.name as product_unit_name',
                'product_variant_prices.price as price',
                'product_variant_prices.star_price as star_price',
            ])
                ->leftJoin('product_variant_prices', 'product_variants.id', '=', 'product_variant_prices.product_variant_id')
                ->leftJoin('products', 'product_variants.product_id', '=', 'products.id')
                ->leftJoin('units', 'product_variants.unit_id', '=', 'units.id')
                ->where('product_variant_prices.business_model', 'b2b')
                ->where('product_variants.id', $request->product_variant_id)
                ->first();

            $orderItem = OrderItem::create([
                'order_id' => $request->order_id,
                'product_variant_id' => $product->id,
                'product_name' => $product->product_name,
                'product_variant_name' => $product->variant_name,
                'product_unit_name' => $product->product_unit_name,
                'product_price' => $partner->group == 'star' ? $product->star_price : $product->price,
            ]);

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
            ]);
        } catch (\Throwable $th) {
            info($th);

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }

    /**
     * Delete order item
     */
    public function deleteProduct(OrderItem $orderItem)
    {
        try {
            DB::beginTransaction();

            $totalPriceForItem = ($orderItem->product_price - $orderItem->product_discount) * $orderItem->quantity;
            $order = $orderItem->order;
            $order->update([
                'grand_total' => $order->grand_total - $totalPriceForItem,
            ]);
            $orderItem->delete();
            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
            ]);
        } catch (\Throwable $th) {
            info($th);

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }

    /**
     * Update quantity and discount in Order Item
     */
    public function updateProduct(Request $request, OrderItem $orderItem)
    {
        try {
            DB::beginTransaction();

            $productVariant = $orderItem->productVariant;
            $stock = $productVariant->stock;
            if ($request->quantity > $stock) {
                return response()->json([
                    'message' => "Quantity $orderItem->product_name $orderItem->product_variant_name melebihi stok produk",
                ], 500);
            }

            $oldTotalPrice = ($orderItem->product_price * $orderItem->quantity) - ($orderItem->product_discount * $orderItem->quantity);

            $orderItem->update([
                'quantity' => $request->quantity,
                'product_discount' => $request->product_discount ? str_replace('.', '', $request->product_discount) : 0,
            ]);

            $newTotalPrice = ($orderItem->product_price * $orderItem->quantity) - ($orderItem->product_discount * $orderItem->quantity);

            $order = $orderItem->order;

            $order->update([
                'grand_total' => $order->grand_total - $oldTotalPrice + $newTotalPrice,
            ]);

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
            ]);
        } catch (\Throwable $th) {
            info($th);

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }

    /**
     * Delete order item on change product type
     */
    public function changeProductType(Request $request, Order $order)
    {
        try {
            DB::beginTransaction();

            $order->update([
                'product_order_type' => $request->product_order_type,
            ]);

            $orderItems = $order->orderItems;

            foreach ($orderItems as $orderItem) {
                $orderItem->delete();
            }

            $order->update([
                'grand_total' => 0,
            ]);

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
            ]);
        } catch (\Throwable $th) {
            info($th);

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }
}
