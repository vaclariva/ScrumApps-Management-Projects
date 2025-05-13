<?php

namespace App\Models;

use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['warehouse_id', 'product_variant_id', 'stock'];

    /**
     * BelongsTo to relationship with ProductVariant.
     */
    public function productVariant():BelongsTo
    {
        return $this->belongsTo(ProductVariant::class);
    }

    /**
     * BelongsTo to relationship with Warehouse.
     */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }


}
