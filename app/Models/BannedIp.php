<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannedIp extends Model
{
    use HasFactory;

    /**
     * Define fillable.
     */
    protected $fillable = [
        'ip_address',
    ];
}
