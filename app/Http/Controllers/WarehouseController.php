<?php

namespace App\Http\Controllers;

use App\Http\Requests\Warehouse\StoreWarehouseRequest;
use App\Http\Requests\Warehouse\UpdateWarehouseRequest;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('warehouses.index');
            // return response()->json(Warehouse::select(['id', 'name', 'desc'])->get());
        } catch (\Throwable $th) {
            info($th);

            abort(500);
        }
    }

    /**
     * Define datatable instance of warehouses.
     */
    public function list(Request $request): JsonResponse
    {
        try {
            $search = $request->input('search')['value'];
            return DataTables::of(
                Warehouse::select(['id', 'name', 'desc'])
                    ->when($search != '', function (Builder $query) use ($search) {
                        $query->where(function (Builder $query) use ($search) {
                            $query->where('name', 'LIKE', '%' . $search . '%')
                                ->orWhere('desc', 'LIKE', '%' . $search . '%');
                        });
                    })
            )
                ->addColumn('actions', fn(Warehouse $warehouse) => view('warehouses.partials.datatable-actions', ['url_delete' => route('warehouses.destroy', $warehouse->id)]))
                ->editColumn('name', fn(Warehouse $warehouse) => view('warehouses.partials.datatable-name', ['warehouse' => $warehouse, 'url_update' => route('warehouses.update', $warehouse->id)]))
                ->editColumn('desc', function ($warehouse) {
                    return !empty($warehouse->desc) ? $warehouse->desc : '-';
                })
                ->addIndexColumn()
                ->editColumn('desc', fn($category) => $category->desc ?? '-')
                ->order(function (Builder $query) use ($request) {
                    $order = $request->input('order')[0];

                    if ($order['column'] == 0) {
                        $query->orderBy('created_at', 'desc');
                    } elseif ($order['column'] == 1) {
                        $query->orderBy('name', $order['dir']);
                    } elseif ($order['column'] == 2) {
                        $query->orderBy('desc', $order['dir']);
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('warehouses.create');
        } catch (\Throwable $th) {
            info($th);

            abort(500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWarehouseRequest $request)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();

            $checkWarehouseNameSoftDeleted = Warehouse::withTrashed()->where('name', $validatedData['name'])->first();
            if (Warehouse::where('name', $validatedData['name'])->first()) {
                return response()->json([
                    'message' => 'Nama sudah ada sebelumnya.',
                ], 500);
            } else if ($checkWarehouseNameSoftDeleted) {
                if ($checkWarehouseNameSoftDeleted->trashed()) {
                    $checkWarehouseNameSoftDeleted->restore();
                }
            } else {
                Warehouse::create($request->validated());
            }

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
                'redirect' => route('warehouses.index'),
            ]);
        } catch (\Throwable $th) {
            info($th);
            DB::rollBack();

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
    public function edit(Warehouse $warehouse)
    {
        try {
            return view('warehouses.edit', ['warehouse' => $warehouse]);
        } catch (\Throwable $th) {
            info($th);

            abort(500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWarehouseRequest $request, Warehouse $warehouse): JsonResponse
    {
        try {
            DB::beginTransaction();

            $warehouse->update($request->validated());

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
                'redirect' => route('warehouses.index'),
            ]);
        } catch (\Throwable $th) {
            info($th);
            DB::rollBack();

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warehouse $warehouse)
    {
        try {
            DB::beginTransaction();

            if ($warehouse->stocks()->where('stock', '>', 0)->exists()) {
                return response()->json([
                    'message' => 'Gagal dihapus, karena lokasi ini sudah tersedia stok.',
                    'redirect' => route('warehouses.index'),
                ], 500);
            } else {
                if ($warehouse->stocks()->exists()) {
                    $warehouse->delete();
                } else {
                    $warehouse->forceDelete();
                }
            }

            DB::commit();

            return response()->json([
                'message' => trans('Berhasil dihapus.'),
                'redirect' => route('warehouses.index'),
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
