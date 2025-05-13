<?php

namespace App\Models;

use App\Models\StockTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'warehouse_id',
        'partner_id',
        'partner_name',
        'partner_address',
        'partner_contact',
        'partner_email',
        'partner_group',
        'so_number',
        'product_order_type',
        'business_type',
        'shipping_cost',
        'extra_discount',
        'grand_total',
        'note',
        'status',
        'ordered_at',
    ];

    /**
     * Define BelongsTo to relationship with User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define BelongsTo to relationship with Warehouse.
     */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    /**
     * Define BelongsTo to relationship with Partner.
     */
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    /**
     * Define HasMany to relationship with OrderItem.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Define BelongsTo to relationship with OrderDelivery.
     */
    public function orderDeliveries()
    {
        return $this->belongsTo(OrderDelivery::class);
    }

    /**
     * Define HasMany to relationship with OrderPayment.
     */
    public function orderPayments()
    {
        return $this->hasMany(OrderPayment::class);
    }

    /**
     * Define morph one relationship with stockTransaction.
     */
    public function stockTransaction(): MorphOne
    {
        return $this->morphOne(StockTransaction::class, 'transactionable');
    }
}
