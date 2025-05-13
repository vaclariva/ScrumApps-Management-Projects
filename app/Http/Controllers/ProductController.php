<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Requests\Variant\StoreVariantRequest;
use App\Models\Category;
use App\Models\ProductVariant;
use App\Models\ProductVariantPrice;
use App\Models\Unit;
use App\Traits\UploadTraits;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class ProductController extends Controller
{

    use UploadTraits;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = Category::all();
            return view('products.index', ['categories' => $categories]);
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
            $search = $request->input('search')['value'];
            $filterVisibility = $request->input('visibility');
            $filterCategory = $request->input('category');
            $filterType = $request->input('type');
            $query = Product::select([
                'products.id',
                'products.name as name',
                'products.feature_image',
                DB::raw('COUNT(DISTINCT CASE WHEN tbr_product_variants.name IS NOT NULL THEN tbr_product_variants.id END) as variant_count'),
                DB::raw('(SELECT GROUP_CONCAT(DISTINCT business_model)
                          FROM tbr_product_variant_prices
                          WHERE tbr_product_variant_prices.is_visible = 1
                          AND tbr_product_variant_prices.product_variant_id IN
                              (SELECT id
                               FROM tbr_product_variants
                               WHERE tbr_product_variants.product_id = tbr_products.id)) as visibility'),
                DB::raw('(SELECT GROUP_CONCAT(tbr_categories.name)
                          FROM tbr_product_categories
                          LEFT JOIN tbr_categories ON tbr_categories.id = tbr_product_categories.category_id
                          WHERE tbr_product_categories.product_id = tbr_products.id) as category_names'),
                'products.type',
                'products.updated_at',
                'products.created_at',
            ])
                ->leftJoin('product_variants', function ($join) {
                    $join->on('products.id', '=', 'product_variants.product_id')
                        ->whereNull('product_variants.deleted_at'); // Hanya ambil yang belum soft delete
                })
                ->leftJoin('product_variant_prices', 'product_variants.id', '=', 'product_variant_prices.product_variant_id')
                ->leftJoin('product_categories', 'products.id', '=', 'product_categories.product_id')
                ->groupBy('products.id');

            return DataTables::of(
                $query
                    ->when($search != '', fn(Builder $query) => $query->where('products.name', 'LIKE', "%{$search}%"))
                    ->when(
                        !empty($filterVisibility),
                        fn(Builder $query) =>
                        $query->whereHas('productVariants.productVariantPrices', function ($q) use ($filterVisibility) {
                            $q->where('is_visible', 1)
                                ->whereIn('business_model', $filterVisibility);
                        })
                    )
                    ->when(
                        !empty($filterCategory),
                        fn(Builder $query) =>
                        $query->whereHas('categories', function ($q) use ($filterCategory) {
                            $q->whereIn('categories.id', $filterCategory);
                        })
                    )
                    ->when(
                        !empty($filterType),
                        fn(Builder $query) =>
                        $query->whereIn('products.type', $filterType)
                    )
            )
                ->addIndexColumn()
                ->editColumn('name', function ($data) {
                    return view('products.partials.listing.datatable-name', [
                        'name' => $data['name'],
                        'feature_image' => $data['feature_image'],
                        'url_edit' => route('products.edit', $data['id'])
                    ]);
                })
                ->addColumn('actions', function ($data) {
                    return view('products.partials.listing.datatable-actions', [
                        'url_delete' => route('products.destroy', $data->id)
                    ]);
                })
                ->editColumn('visibility', function ($product) {
                    return $product->visibility ? strtoupper($product->visibility) : '-';
                })
                ->editColumn('total_variant', function ($product) {
                    return $product->variant_count > 0
                        ? $product->variant_count . ' Varian'
                        : 'Tanpa Varian';
                })
                ->editColumn('categories', function ($product) {
                    return $product->category_names;
                })
                ->editColumn('type', function ($product) {
                    return $product->type == 'Popular' ? 'Populer' : $product->type;
                })
                ->editColumn('updated_at', function ($product) {
                    return Carbon::parse($product->updated_at)->translatedFormat('d F Y H:i');
                })
                ->order(function (Builder $query) use ($request) {
                    $order = $request->input('order')[0];

                    if ($order['column'] == 0) {
                        $query->orderBy('updated_at', 'desc');
                    } elseif ($order['column'] == 1) {
                        $query->orderBy('name', $order['dir']);
                    } elseif ($order['column'] == 2) {
                        $query->orderBy('variant_count', $order['dir']);
                    } elseif ($order['column'] == 3) {
                        $query->orderBy('visibility', $order['dir']);
                    } elseif ($order['column'] == 4) {
                        $query->orderBy('category_names', $order['dir']);
                    } elseif ($order['column'] == 5) {
                        $query->orderBy('type', $order['dir']);
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('products.create', [
                'categories' => Category::where('name', '!=', 'Uncategories')->get(),
                'units' => Unit::all(),
            ]);
        } catch (\Throwable $th) {
            info($th);

            abort(500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();

            $validatedData['categories'] = $validatedData['categories'] ?? 1;

            $product = Product::create(array_merge(
                Arr::except($validatedData, ['feature_image'])
            ));

            if ($request->hasFile('feature_image')) {
                $product->update([
                    'feature_image' => $this->uploadFile(image: $request->file('feature_image'), subFolder: 'products'),
                ]);
            }

            $product->categories()->sync($validatedData['categories']);
            $productVariant = $product->productVariants()->create([
                'unit_id' => $request->has_variant ? null : $validatedData['unit_id'],
            ]);
            $businessModels = ['b2b', 'b2c'];
            foreach ($businessModels as $model) {
                $productVariant->productVariantPrices()->create([
                    'business_model' => $model,
                    'is_visible' => 1,
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
                'redirect' => $validatedData['has_variant'] == 1 ? route('products.indexVariant', $product->id) : route('products.indexB2b', $product->id),
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
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $productVariant = $product->productVariants()->whereNull('name')->withTrashed()->first();

        return view('products.edit', [
            'category_id' => $product->categories()->pluck('categories.id'),
            'categories' => Category::where('name', '!=', 'Uncategories')->get(),
            'product' => $product,
            'units' => Unit::all(),
            'unit_id' => $productVariant ? $productVariant->unit_id : null,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();

            $validatedData['categories'] = $validatedData['categories'] ?? 1;

            $productUpdated = $product->update(array_merge(
                Arr::except($validatedData, ['feature_image'])
            ));

            if ($productUpdated) {
                $productVariants = $product->productVariants();
                if ($validatedData['has_variant'] == 0) {
                    $productVariantsNameNull = $product->productVariants()->withTrashed()->whereNull('name')->first();

                    if (!$productVariantsNameNull) {
                        $productVariant = $product->productVariants()->create([
                            'unit_id' => $validatedData['unit_id'],
                        ]);

                        $productVariantNameNotNull = $product->productVariants()->withTrashed()->whereNotNull('name')->get();
                        foreach ($productVariantNameNotNull as $pv) {
                            $pv->delete();
                            $variantPrices = $pv->productVariantPrices()->withTrashed()->get();
                            foreach ($variantPrices as $price) {
                                $price->delete();
                            }
                        }

                        $businessModels = ['b2b', 'b2c'];
                        foreach ($businessModels as $model) {
                            $productVariant->productVariantPrices()->create([
                                'business_model' => $model,
                                'is_visible' => 1,
                            ]);
                        }
                    }

                    if ($productVariantsNameNull) {
                        if ($productVariantsNameNull->trashed()) {
                            $productVariantsNameNull->restore();
                        }

                        foreach ($productVariantsNameNull->productVariantPrices()->withTrashed()->get() as $variantPrice) {
                            if ($variantPrice->trashed()) {
                                $variantPrice->restore();
                            }
                        }

                        $product->productVariants()->whereNotNull('name')->delete();


                        $productVariantWhere = $productVariants->withTrashed()->where('product_id', $productVariantsNameNull->product_id)->pluck('id');
                        $productVariantPrices = ProductVariantPrice::whereIn('product_variant_id', $productVariantWhere)->where('product_variant_id', '!=', $productVariantsNameNull->id)->get();

                        foreach ($productVariantPrices as $price) {
                            $price->delete();
                        }
                    }
                }

                if ($validatedData['has_variant'] == 1) {
                    $productVariants = $product->productVariants()->get();

                    // Mencari ProductVariant yang name nya NULL untuk dihapus (soft-delete)
                    $productVariantNameNull = $product->productVariants()->whereNull('name')->withTrashed()->first();

                    if ($productVariantNameNull) {
                        // Lalu dihapus jika ditemukan
                        $productVariantNameNull->delete();
                    } else {
                        info('Tidak ada ProductVariant dengan name NULL yang ditemukan.');
                    }

                    // Mencari ProductVariant yang name nya NULL dengan Collection
                    $productVariantA = $product->productVariants()->whereNull('name')->withTrashed()->get();
                    foreach ($productVariantA as $pv) {
                        // Mendapatkan ProductVariantPrice turunan dari $productVariantA
                        $variantPrices = $pv->productVariantPrices()->withTrashed()->get();
                        foreach ($variantPrices as $price) {
                            // Menghapus ProductVariantPrice
                            $price->delete();
                        }
                    }

                    // Mencari ProductVariant yang name nya NOT NULL
                    $productVariantB = $product->productVariants()->whereNotNull('name')->withTrashed()->get();

                    foreach ($productVariantB as $pv) {
                        // Mendapatkan ProductVariantPrice turunan dari $productVariantB
                        $variantPrices = $pv->productVariantPrices()->withTrashed()->get();
                        foreach ($variantPrices as $price) {
                            // Me-restore ProductVariantPrice
                            if ($price->trashed()) {
                                $price->restore();
                            }
                        }
                    }

                    $product->productVariants()->withTrashed()->whereNotNull('name')->restore();
                }
            }

            if ($request->hasFile('feature_image')) {
                $this->deleteFile($product->feature_image);

                $product->update([
                    'feature_image' => $this->uploadFile(image: $request->file('feature_image'), subFolder: 'products'),
                ]);
            }

            $product->categories()->sync($validatedData['categories']);

            if ($validatedData['has_variant'] == 0) {
                $productVariants->whereNull('name')->update([
                    'unit_id' => $validatedData['unit_id'],
                ]);
            }

            $product->touch();
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            DB::beginTransaction();


            if (
                $product->productVariants()->whereHas('stocks', function ($query) {
                    $query->where('stock', '>', 0);
                })->exists()
            ) {
                return response()->json([
                    'message' => 'Gagal dihapus, karena produk ini sudah tersedia stok.',
                    'redirect' => route('warehouses.index'),
                ], 500);
            } else {
                if ($product->productVariants()->whereHas('stocks')->exists()) {
                    $variants = $product->productVariants;

                    foreach ($variants as $variant) {
                        $vp = $variant->productVariantPrices()->get();
                        foreach ($vp as $prices) {
                            info('$prices');
                            info($prices);
                            $prices->delete();
                        }
                        $variant->delete();
                    }
                    $product->productCategories()->delete();
                    $product->delete();
                } else {
                    $variants = $product->productVariants;

                    foreach ($variants as $variant) {
                        $vp = $variant->productVariantPrices()->get();
                        foreach ($vp as $prices) {
                            info('$prices');
                            info($prices);
                            $prices->forceDelete();
                        }
                        $variant->forceDelete();
                    }
                    $product->productCategories()->forceDelete();
                    $product->forceDelete();
                }
            }

            if ($product->getRawOriginal('feature_image')) {
                $this->deleteFile($product->getRawOriginal('feature_image'));
            }

            $product->delete();

            DB::commit();

            return response()->json([
                'message' => trans('Berhasil dihapus.'),
                'redirect' => route('products.index'),
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
     * Display a listing of the resource "B2B Variant".
     */
    public function indexB2b(Product $product)
    {
        try {
            $hasVariant = $product->has_variant;
            $data = ProductVariant::select('product_variants.name as variant_name', 'product_variants.image', 'product_variant_prices.*')
                ->leftJoin('product_variant_prices', 'product_variants.id', '=', 'product_variant_prices.product_variant_id')
                ->leftJoin('units', 'product_variants.unit_id', '=', 'units.id')
                ->when(!$hasVariant, fn(Builder $query) => $query->whereNull('product_variants.name'))
                ->when($hasVariant, fn(Builder $query) => $query->whereNotNull('product_variants.name'))
                ->where('product_variant_prices.business_model', 'b2b')
                ->where('product_variants.product_id', $product->id)
                ->get();

            $isAllVisible = $data->every(fn($item) => $item->is_visible == 1);

            $productVariant = $hasVariant ? $data : $data[0] ?? [];
            return view($hasVariant ? 'products.b2b-variant' : 'products.b2b', [
                'product' => $product,
                'product_variants' => $productVariant,
                'is_all_visible' => $isAllVisible ? true : false
            ]);
        } catch (\Throwable $th) {
            info($th);

            abort(500);
        }
    }

    /**
     * Store and Update a newly B2B Variant in storage.
     */
    public function storeB2b(Request $request, Product $product)
    {
        try {
            DB::beginTransaction();
            if ($product->has_variant) {
                $productVariantPrice = ProductVariantPrice::where('id', $request->product_variant_id)->where('business_model', 'b2b')->first();
                $productVariantPrice->update([
                    'is_visible' => $request->is_visible,
                    'price' => str_replace('.', '', $request->price),
                    'star_price' => str_replace('.', '', $request->star_price),
                ]);
            } else {
                $productVariant = ProductVariant::where('product_id', $product->id)->first();
                $productVariantPrices = ProductVariantPrice::where('business_model', 'b2b')->where('product_variant_id', $productVariant->id)->update([
                    'is_visible' => $request->is_visible ?? 0,
                    'price' => $request->price ? str_replace('.', '', $request->price) : 0,
                    'star_price' => $request->star_price ? str_replace('.', '', $request->star_price) : 0,
                ]);
            }

            $product->touch();

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

    public function storeB2bVisibility(Request $request, Product $product)
    {
        try {
            DB::beginTransaction();
            $productVariants = $product->productVariants()->whereNotNull('name')->get();

            foreach ($productVariants as $productVariant) {
                $productVariant->productVariantPrices()->where('business_model', 'b2b')->update([
                    'is_visible' => $request->is_visible,
                ]);
            }

            $product->touch();
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

    /**
     * Display a listing of the resource "B2C Variant".
     */
    public function indexB2c(Product $product)
    {
        try {
            $hasVariant = $product->has_variant;
            $data = ProductVariant::select('product_variants.name as variant_name', 'product_variants.image' ,'product_variant_prices.*')
                ->leftJoin('product_variant_prices', 'product_variants.id', '=', 'product_variant_prices.product_variant_id')
                ->leftJoin('units', 'product_variants.unit_id', '=', 'units.id')
                ->when(!$hasVariant, fn(Builder $query) => $query->whereNull('product_variants.name'))
                ->when($hasVariant, fn(Builder $query) => $query->whereNotNull('product_variants.name'))
                ->where('product_variant_prices.business_model', 'b2c')
                ->where('product_variants.product_id', $product->id)
                ->get();

            $isAllVisible = $data->every(fn($item) => $item->is_visible == 1);

            $productVariant = $hasVariant ? $data : $data[0] ?? [];
            return view($hasVariant ? 'products.b2c-variant' : 'products.b2c', [
                'product' => $product,
                'product_variants' => $productVariant,
                'is_all_visible' => $isAllVisible ? true : false
            ]);
        } catch (\Throwable $th) {
            info($th);

            abort(500);
        }
    }

    /**
     * Store and Update a newly B2C Variant in storage.
     */
    public function storeB2c(Request $request, Product $product)
    {
        try {
            DB::beginTransaction();
            if ($product->has_variant) {
                $productVariantPrice = ProductVariantPrice::where('id', $request->product_variant_id)->where('business_model', 'b2c')->first();
                $productVariantPrice->update([
                    'is_visible' => $request->is_visible,
                    'price' => str_replace('.', '', $request->price),
                ]);
            } else {
                $productVariant = ProductVariant::where('product_id', $product->id)->first();
                $productVariantPrices = ProductVariantPrice::where('business_model', 'b2c')->where('product_variant_id', $productVariant->id)->update([
                    'is_visible' => $request->is_visible ?? 0,
                    'price' => $request->price ? str_replace('.', '', $request->price) : 0,
                ]);
            }

            $product->touch();

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

    public function storeB2cVisibility(Request $request, Product $product)
    {
        try {
            DB::beginTransaction();
            $productVariants = $product->productVariants()->whereNotNull('name')->get();

            foreach ($productVariants as $productVariant) {
                $productVariant->productVariantPrices()->where('business_model', 'b2c')->update([
                    'is_visible' => $request->is_visible,
                ]);
            }

            $product->touch();
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

    /**
     * Display a listing of the resource "Variant".
     */
    public function indexVariant(Product $product)
    {
        if (!$product->has_variant) {
            abort(403);
        }
        try {
            $variants = $product->productVariants;
            foreach ($variants as $variant) {
                $unit = Unit::withTrashed()->where('id', $variant->unit_id)->first();
                if ($unit) {
                    $variant->unit_deleted_at = $unit->deleted_at;
                    $variant->unit_deleted_name = $unit->name;
                }
            }
            $units = Unit::all();
            return view('products.variant', [
                'variants' => $variants,
                'product' => $product,
                'units' => $units,
            ]);
        } catch (\Throwable $th) {
            info($th);

            abort(500);
        }
    }

    /**
     * Store and Update a newly Variant in storage.
     */
    public function storeVariant(StoreVariantRequest $request, Product $product)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();

            if (!is_null($request->product_variant_id) && $request->product_variant_id != 'undefined') {
                $productVariant = $product->productVariants()->withTrashed()->where('id', $request->product_variant_id)->first();

                if ($productVariant) {
                    if ($productVariant->trashed()) {
                        $productVariant->restore();

                        $productVariant->productVariantPrices()->restore();

                        $productVariant->productVariantPrices()->update([
                            'is_visible' => 1,
                        ]);
                    }

                    $productVariant->update($validatedData);

                    if ($request->hasFile('image')) {
                        $uploadedImagePath = $this->uploadFile(
                            image: $request->file('image'),
                            subFolder: 'products/variants'
                        );

                        $productVariant->update([
                            'image' => $uploadedImagePath,
                        ]);
                    }
                }
            } else {
                $productVariant = $product->productVariants()
                    ->withTrashed()
                    ->where('name', $validatedData['name'])
                    ->first();

                if ($productVariant) {
                    if ($productVariant->trashed()) {
                        $productVariant->restore();
                        $productVariant->update($validatedData);
                        $productVariant->productVariantPrices()->restore();
                        $productVariant->productVariantPrices()->update([
                            'is_visible' => 1,
                        ]);
                    }
                } else {
                    $productVariant = ProductVariant::create(array_merge(
                        Arr::except($validatedData, ['image'])
                    ));
                    if ($request->hasFile('image')) {
                        $uploadedImagePath = $this->uploadFile(
                            image: $request->file('image'),
                            subFolder: 'products/variants'
                        );
                        $productVariant->update([
                            'image' => $uploadedImagePath,
                        ]);
                    }
                }

                $businessModels = ['b2b', 'b2c'];
                foreach ($businessModels as $model) {
                    $productVariant->productVariantPrices()->create([
                        'business_model' => $model,
                        'is_visible' => 1,
                    ]);
                }
            }

            $product->touch();

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
                'id' => $productVariant->id,
                'url_delete' => route('products.destroyVariant', [$request->product_id, $productVariant->id]),
                'url_remove_photo' => route('products.deleteImageVariant', [$request->product_id, $productVariant->id])
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
     * Remove the specified Variant from storage.
     */
    public function destroyVariant(Product $product, ProductVariant $productVariant)
    {
        try {
            DB::beginTransaction();
            if ($productVariant->stocks()->where('stock', '>', 0)->exists()) {
                return response()->json([
                    'message' => 'Gagal dihapus, karena varian ini sudah tersedia stok.',
                    'redirect' => route('warehouses.index'),
                ], 500);
            } else {
                if ($productVariant->stocks()->exists()) {
                    $productVariant->productVariantPrices()->update([
                        'is_visible' => 0,
                    ]);
                    $productVariant->productVariantPrices()->delete();

                    $productVariant->delete();
                } else {
                    $productVariant->productVariantPrices()->forceDelete();

                    $productVariant->forceDelete();
                }
            }

            if ($productVariant->getRawOriginal('image')) {
                $this->deleteFile($productVariant->getRawOriginal('image'));
            }

            $product->touch();

            DB::commit();

            return response()->json([
                'message' => trans('Berhasil dihapus.'),
            ]);
        } catch (\Throwable $th) {
            info($th);
            DB::rollBack();

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }

    public function deleteImageVariant(Product $product, ProductVariant $productVariant)
    {
        try {
            DB::beginTransaction();

            if ($productVariant->getRawOriginal('image')) {
                $this->deleteFile($productVariant->getRawOriginal('image'));
            }

            $productVariant->update([
                'image' => null
            ]);

            $product->touch();

            DB::commit();

            return response()->json([
                'message' => trans('Berhasil dihapus.'),
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
     * Check for soft-deleted variant.
     */
    public function checkVariant(Request $request, Product $product)
    {
        $existingVariant = $product->productVariants()->withTrashed()
            ->where('name', $request->name)
            ->first();

        if ($existingVariant) {
            if ($existingVariant->trashed()) {
                return response()->json([
                    'exists' => true,
                    'message' => 'Variant name is already used but deleted.',
                    'can_restore' => true,
                    'data' => $existingVariant
                ]);
            } else {
                return response()->json([
                    'exists' => true,
                    'message' => 'Variant name is already in use.',
                    'data' => $existingVariant,
                ]);
            }
        } else {
            return response()->json([
                'exists' => false,
                'message' => 'Variant name is available.'
            ]);
        }
    }
}
