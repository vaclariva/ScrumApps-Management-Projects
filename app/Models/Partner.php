<?php

namespace App\Models;

use App\Notifications\Partner\CreatePasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Partner extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'province_id',
        'regency_id',
        'district_id',
        'address',
        'group',
        'is_access_product_dev',
        'credit_limit',
        'blocked',
        'password',
        'is_weak_password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Define BelongsTo to relationship with Regency.
     */
    public function regency()
    {
        return $this->belongsTo(Regency::class, 'regency_id');
    }

    /**
     * Define BelongsTo to relationship with District.
     */
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    /**
     * Send a create password notification to the partner.
     */
    public function sendCreatePasswordNotification(): void
    {
        $urlB2b = config('app.url_b2b');
        $token = Password::createToken($this);
        $email = $this->email;
        $url = $urlB2b . '/reset-password/' . urlencode($token) . '?email=' . urlencode($email);

        $this->notify(new CreatePasswordNotification($url, $this));
    }
}
