<?php

namespace App\Http\Controllers\Auth;

use App\Traits\AuthLog;
use App\Models\BannedIp;
use Illuminate\View\View;
use App\Traits\HasTwoFactor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    use HasTwoFactor, AuthLog;

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {

            $request->authenticate();

            $request->session()->regenerate();

            $cookieLifetime = 10080; // Seminggu
            Cookie::queue(Cookie::make('status', 'admin', $cookieLifetime));

            if (! $this->isIpExists($request) &&
                ! $this->isBanned($request) &&
                ! $this->isIpBanned($request) &&
                $this->isTwoFactor($request)) {

                $request->user()->sendTwoFactorNotification($request);

                $this->setLastLogStatusTo($request->user(), 'Verification');

                return response()->json([
                    'message' => 'Mengalihkan ..',
                    'redirect' => route('twofactor.verify')
                ], 200);
            } else {

                return response()->json([
                    'message' => trans('auth.logged-in'),
                    'redirect' => session()->pull('url.intended', route('dashboard'))
                ]);
            }

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        try {
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return response()->json([
                'message' => 'Berhasil keluar.',
                'redirect' => route('login')
            ]);


        }catch (\Throwable $th) {
            info($th);

            return response()->json([
                'message' => 'Gagal keluar.',
            ], 500);
        }
    }

    /**
     * Check the request user if they have logged in using the same ip.
     */
    protected function isIpExists(Request $request): bool
    {
        return in_array($request->ip(), $request->user()->twoFactors->pluck('two_factor_ip')->toArray()) ? true : false;
    }

    /**
     * Check the request user if they have been banned from the app.
     */
    protected function isBanned(Request $request): bool
    {
        return $request->user()->blocked ? true : false;
    }

    /**
     * Check the request user if they ip has been banned.
     */
    protected function isIpBanned(Request $request): bool
    {
        return BannedIp::where('ip_address', $request->ip())->exists() ? true : false;
    }

    /**
     * Check if two factor authentication is enabled.
     */
    protected function isTwoFactor(Request $request): bool
    {
        return $request->user()->enabled_2fa ? true : false;
    }

}
