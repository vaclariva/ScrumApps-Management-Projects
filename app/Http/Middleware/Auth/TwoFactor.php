<?php

namespace App\Http\Middleware\Auth;

use App\Traits\AuthLog;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TwoFactor
{
    use AuthLog;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (!auth()->check()) {
            return $next($request);
        }

        if (!$user->enabled_2fa) {
            return $next($request);
        }

        $twoFactor = $user->twoFactors->where('two_factor_ip', $request->ip())->first();

        if (!$twoFactor || !$twoFactor->two_factor_code) {
            if (!$request->is('verify*') && !$request->is('twofactor*')) {
                return redirect()->route('twofactor.verify');
            }
            return $next($request);
        }

        if ($twoFactor->two_factor_expires_at->lt(now())) {
            $user->deleteTwoFactorCode($request->ip());
            auth()->logout();

            $this->setLastLogStatusTo($user, 'Verification');

            return redirect()->route('login')
                ->with('error', 'The two factor code has expired. Please login again.');
        }

        if ($request->is('verify*') || $request->is('twofactor*')) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
