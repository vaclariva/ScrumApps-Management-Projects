<?php

namespace App\Models;

use App\Models\StockHistory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockTransaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['warehouse_id', 'transactionable_type', 'transactionable_id', 'user_id', 'type'];

    /**
     * Define HasMany to relationship with productCategories .
     */
    public function stockHistories(): HasMany
    {
        return $this->hasMany(StockHistory::class);
    }

    /**
     * Define morph relationship to another table
     */
    public function transactionable(): MorphTo
    {
        return $this->morphTo();
    }
}
