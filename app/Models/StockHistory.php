<?php

namespace App\Models;

use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockHistory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'stock_transaction_id',
        'warehouse_id',
        'product_variant_id',
        'begin_stock',
        'quantity',
        'ending_stock',
        'in_out_flag',
        'movement_type',
        'correction',
        'user_id'
    ];


    /**
     * BelongsTo to relationship with Product.
     */
    public function productVariant():BelongsTo
    {
        return $this->belongsTo(ProductVariant::class);
    }

    /**
     * BelongsTo to relationship with Product.
     */
    public function stockTransaction():BelongsTo
    {
        return $this->belongsTo(StockTransaction::class);
    }

    /**
     * BelongsTo to relationship with Warehouse.
     */
    public function warehouse():BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }
}
