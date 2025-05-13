<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('categories.index', ['categories' => Category::all()]);
        } catch (\Throwable $th) {
            info($th);

            abort(500);
        }
    }

    /**
     * Define datatable instance of categories.
     */
    public function list(Request $request): JsonResponse
    {
        try {
            $search = $request->input('search')['value'];
            return DataTables::of(
                Category::select(['id', 'name', 'desc'])
                    ->when($search != '', function (Builder $query) use ($search) {
                        $query->where(function (Builder $query) use ($search) {
                            $query->where('name', 'LIKE', '%' . $search . '%')
                                ->orWhere('desc', 'LIKE', '%' . $search . '%');
                        });
                    })
            )
                ->addColumn('actions', fn(Category $category) => view('categories.partials.datatable-actions', ['url_delete' => route('categories.destroy', $category->id), 'name' => $category->name]))
                ->editColumn('name', fn(Category $category) =>view('categories.partials.datatable-name', ['category' => $category, 'url_update' => route('categories.update', $category->id)]))
                ->editColumn('desc', function ($category) {
                    return !empty($category->desc) ? $category->desc : '-';
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
            return view('categories.create');
        } catch (\Throwable $th) {
            info($th);

            abort(500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            DB::beginTransaction();

            Category::create($request->validated());

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
                'redirect' => route('categories.index'),
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
    public function edit(Category $category)
    {
        try {
            return view('categories.edit', ['category' => $category]);
        } catch (\Throwable $th) {
            info($th);

            abort(500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            DB::beginTransaction();

            if ($category->name == 'Uncategories') {
                $category->update([
                    'desc' => $request->desc
                ]);
            } else {
                $category->update($request->validated());
            }

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
                'redirect' => route('categories.index'),
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
    public function destroy(Category $category)
    {
        try {
            if ($category->name == 'Uncategories') {
                return abort(403);
            }
            DB::beginTransaction();

            $category->delete();

            DB::commit();

            return response()->json([
                'message' => trans('Berhasil dihapus.'),
                'redirect' => route('categories.index'),
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
