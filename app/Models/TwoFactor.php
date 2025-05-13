<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TwoFactor extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'two_factor_ip', 'two_factor_code', 'two_factor_expires_at'];

    /**
     * Define casts.
     */
    protected $casts = [
        'two_factor_expires_at' => 'datetime',
    ];

    /**
     * Belongs To relationship with user.
     */
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
