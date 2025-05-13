<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDelivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'shipping_address',
        'status',
    ];

    /**
     * Define BelongsTo to relationship with Order.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
