<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MinimumStock extends Model
{
    use HasFactory;

    protected $fillable = ['warehouse_id', 'product_variant_id', 'minimum_stock'];

    /**
    * Define HasMany to relationship with warehouses .
    */
    public function warehouses(): HasMany
    {
        return $this->hasMany(Warehouse::class);
    }

    /**
    * Define HasMany to relationship with productVariants .
    */
    public function productVariants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }
}
