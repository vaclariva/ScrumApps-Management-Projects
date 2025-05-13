<?php

namespace App\Models;

use App\Models\Stock;
use App\Models\StockHistory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class ProductVariant extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['product_id', 'unit_id', 'name', 'image', 'deleted_at'];

    /**
     * BelongsTo Belongs To to relationship with Product.
     */
    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

        /**
     * BelongsTo Belongs To to relationship with Product.
     */
    public function unit():BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * Define HasMany to relationship with product Variant Price.
     */
    public function productVariantPrices(): HasMany
    {
        return $this->hasMany(ProductVariantPrice::class);
    }

    /**
     * Define HasMany to relationship with Stock.
     */
    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }

    /**
     * Define HasMany to relationship with Stock History.
     */
    public function stockHistories(): HasMany
    {
        return $this->hasMany(StockHistory::class);
    }

    /**
    * Define HasMany to relationship with minimumStocks .
    */
    public function minimumStocks(): HasMany
    {
        return $this->hasMany(MinimumStock::class);
    }

    /**
     * Define accessor for product variant name attribute.
     */
    protected function productVariantName(): Attribute
    {
        $product = $this->product()->first();
        $variantName = $this->name ? ' - '.$this->name : null;

        return Attribute::make(
            get: fn () =>  $product->name.$variantName
        );
    }

    /**
     * function utk mendapatkan stok berdasarkan warehouse_id.
     */
    public function getWarehouseStock(int $warehouseId): float
    {
        $productStock = $this->stocks()->where('warehouse_id', $warehouseId)->first();

        return $productStock ? round($productStock->stock, 2) : 0;
    }

    /**
     * Define accessor for unit name attribute.
     */
    protected function unitName(): Attribute
    {
        $unit = $this->unit()->first();
        return Attribute::make(
            get: fn () =>  $unit ? $unit->name : '-',
        );
    }

    /**
     * Define function for checking the user's avatar.
     */
    protected function isImageExist(string $path): bool
    {
        return Storage::disk(config('filesystems.default'))->exists($path);
    }

    /**
     * Define accessor for image attribute.
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value != null
            ? (
                $this->isImageExist($value)
                ? Storage::url($value)
                : asset('assets/images/gallery.png')
            )
            : asset('assets/images/gallery.png')
        );
    }

}
