<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'desc'];

    /**
     * Has Many to relationship with Stock.
     */
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    /**
     * Has Many to relationship with Stock.
     */
    public function stockHistories()
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

}
