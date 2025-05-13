<?php

namespace App\Traits;

use App\Models\TwoFactor;

trait HasTwoFactor
{
    /**
     * Relasi one to many dengan two factor
     */
    public function twoFactors()
    {
        return $this->hasMany(TwoFactor::class);
    }

    /**
     * Generate Two Factor Code
     */
    public function generateTwoFactorCode($ip)
    {
        $code = rand(100000, 999999);

        if ($this->twoFactors->contains('two_factor_ip', $ip)) {
            $this->twoFactors->where('two_factor_ip', $ip)->first()->update([
                'two_factor_ip' => $ip,
                'two_factor_code' => $code,
                'two_factor_expires_at' => now()->addMinutes(config('auth.two_factor_expired')),
            ]);
        } else {
            $this->twoFactors()->create([
                'two_factor_ip' => $ip,
                'two_factor_code' => $code,
                'two_factor_expires_at' => now()->addMinutes(config('auth.two_factor_expired')),
            ]);
        }

        return $code;
    }

    /**
     * Reset Two Factor Code
     */
    public function resetTwoFactorCode($ip)
    {
        $two_factor = $this->twoFactors()->where('two_factor_ip', $ip)->first();

        if ($two_factor) {
            $this->twoFactors()->update([
                'two_factor_code' => null,
                'two_factor_expires_at' => null,
            ]);
        }
    }

    /**
     * Delete Two Factor Code
     */
    public function deleteTwoFactorCode($ip)
    {
        $two_factor = $this->twoFactors()->where('two_factor_ip', $ip)->first();

        if ($two_factor) {
            $this->twoFactors()->delete();
        }
    }
}
