<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regency extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Define HasMany to relationship with District.
     */
    public function districts()
    {
        return $this->hasMany(District::class, 'regency_id');
    }
}
