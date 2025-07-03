<?php

namespace App\Http\Controllers\Auth;

use App\Traits\AuthLog;
use App\Models\BannedIp;
use Illuminate\View\View;
use App\Traits\HasTwoFactor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
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
        try {
            info('Login attempt for email: ' . $request->email);

            $request->authenticate();

            $request->session()->regenerate();

            $cookieLifetime = 10080; // Seminggu
            Cookie::queue(Cookie::make('status', 'admin', $cookieLifetime));

            info('User authenticated successfully: ' . $request->user()->id);

            // Check if IP is banned
            if ($this->isIpBanned($request)) {
                info('IP is banned: ' . $request->ip());
                Auth::logout();
                return response()->json([
                    'message' => trans('auth.ip-banned'),
                ], 401);
            }

            // Check if Two Factor is enabled and IP is not verified
            if ($this->isTwoFactor($request) && !$this->isIpExists($request)) {
                info('2FA required for user: ' . $request->user()->id);
                $request->user()->sendTwoFactorNotification($request);
                $this->setLastLogStatusTo($request->user(), 'Verification');

                return response()->json([
                    'message' => 'Mengalihkan ke verifikasi Two Factor...',
                    'redirect' => route('twofactor.verify')
                ], 200);
            }

            // Clear user cache after successful login
            $userId = $request->user()->id;
            Cache::forget("user_projects_{$userId}");
            Cache::forget("dashboard_data_{$userId}");

            // Log successful login
            $this->setLastLogStatusTo($request->user(), 'Logged In');

            $redirectUrl = session()->pull('url.intended', route('dashboard'));
            info('Login successful, redirecting to: ' . $redirectUrl);

            return response()->json([
                'message' => trans('auth.logged-in'),
                'redirect' => $redirectUrl
            ], 200);

        } catch (\Throwable $th) {
            info('Login Error:', [$th]);

            return response()->json([
                'message' => 'Terjadi kesalahan saat login. Silakan coba lagi.',
            ], 500);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        try {
            $userId = $request->user()->id;

            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            // Clear user cache on logout
            Cache::forget("user_projects_{$userId}");
            Cache::forget("dashboard_data_{$userId}");

            return response()->json([
                'message' => 'Berhasil keluar.',
                'redirect' => route('login')
            ]);

        } catch (\Throwable $th) {
            info('Logout Error:', [$th]);

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
        // Return false since blocked user is not implemented
        return false;
        // return $request->user()->blocked ? true : false;
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
