<?php

namespace App\Http\Controllers;

use App\Http\Requests\Unit\StoreUnitRequest;
use App\Http\Requests\Unit\UpdateUnitRequest;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('units.index');
        } catch (\Throwable $th) {
            info($th);

            abort(500);
        }
    }

    /**
     * Define datatable instance of units.
     */
    public function list(Request $request): JsonResponse
    {
        try {
            $search = $request->input('search')['value'];
            return DataTables::of(
                Unit::select(['id', 'name', 'desc'])
                    ->when($search != '', function (Builder $query) use ($search) {
                        $query->where(function (Builder $query) use ($search) {
                            $query->where('name', 'LIKE', '%' . $search . '%')
                                ->orWhere('desc', 'LIKE', '%' . $search . '%');
                        });
                    })
            )
            ->addColumn('actions', fn (Unit $unit) => view('units.partials.datatable-actions', ['url_delete' => route('units.destroy', $unit->id)]))
            ->editColumn('name', fn(Unit $unit) => view('units.partials.datatable-name', ['unit' => $unit, 'url_update' => route('units.update', $unit->id)]))
            ->editColumn('desc', function ($unit) {
                return !empty($unit->desc) ? $unit->desc : '-';
            })
            ->addIndexColumn()
            ->order(function (Builder $query) use ($request) {
                $order = $request->input('order')[0];

                if ($order['column'] == 0) {
                    $query->orderBy('created_at', 'desc');
                } elseif ($order['column'] == 1) {
                    $query->orderBy('name', $order['dir']);
                } elseif ($order['column'] == 3) {
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
            return view('units.create');
        } catch (\Throwable $th) {
            info($th);

            abort(500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUnitRequest $request)
    {
        try {
            DB::beginTransaction();

            Unit::create($request->validated());

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
                'redirect' => route('units.index'),
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
    public function edit(Unit $unit)
    {
        try {
            return view('units.edit', ['unit' => $unit]);
        } catch (\Throwable $th) {
            info($th);

            abort(500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUnitRequest $request, Unit $unit): JsonResponse
    {
        try {
            DB::beginTransaction();

            $unit->update($request->validated());

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
                'redirect' => route('units.index'),
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
    public function destroy(Unit $unit)
    {
        try {
            DB::beginTransaction();

            $unit->delete();

            DB::commit();

            return response()->json([
                'message' => trans('Berhasil dihapus.'),
                'redirect' => route('units.index'),
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
