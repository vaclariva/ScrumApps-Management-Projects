<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\TwoFactor;
use App\Notifications\Auth\CreatePasswordNotification;
use App\Notifications\Auth\ResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use App\Notifications\Auth\TwoFactorNotification;
use App\Traits\HasTwoFactor;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Password;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasTwoFactor;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
        'role',
        'photo_path',
        'gender',
        'blocked_at',
        'is_weak_password',
        'enabled_2fa',
        'phone_number'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'enabled_2fa' => 'boolean',
        ];
    }

    /**
     * Define HasMany to relationship with two factor .
     */
    public function twoFactors(): HasMany
    {
        return $this->hasMany(TwoFactor::class);
    }

    /**
     * Send a two factor notification to the user.
     */
    public function sendTwoFactorNotification($request)
    {
        $this->notify(new TwoFactorNotification($this->generateTwoFactorCode($request->ip())));
    }

    /**
     * Send a password reset notification to the user.
     */
    public function sendPasswordResetNotification($token): void
    {
        $url = route('password.reset', ['token' => $token, 'email' => $this->email]);

        $this->notify(new ResetPasswordNotification($url, $this));
    }

    /**
     * Send a create password notification to the user.
     */
    public function sendCreatePasswordNotification(): void
    {
        $url = route('password.reset', ['token' => Password::createToken($this), 'email' => $this->email]);

        $this->notify(new CreatePasswordNotification($url, $this));
    }

    /**
     * Define function for checking the user's avatar.
     */
    protected function isPhotoPathExist(string $path): bool
    {
        return Storage::disk(config('public'))->exists($path);
    }

    /**
     * Define accessor for avatar attribute.
     */
    protected function photoPath(): Attribute
    {
        return Attribute::make(
            get: function ($value) {

                if ($value && Storage::disk('public')->exists($value)) {
                    return Storage::url($value);
                }
                return asset('assets/images/avatar.png');
            }
        );
    }

    /**
     * Define accessor for is superadmin.
     */
    protected function isSuperadmin(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->role == 'Superadmin'
        );
    }

    /**
     * Define accessor for is password null.
     */
    protected function isPasswordNull(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->password == NULL
        );
    }

    public function getRoleLabelAttribute()
    {
        return \Illuminate\Support\Str::headline($this->role);
    }
    public function team()
    {
        return $this->hasOne(Team::class);
    }
}
