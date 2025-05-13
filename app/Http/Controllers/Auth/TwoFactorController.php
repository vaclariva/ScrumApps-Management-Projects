<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use App\Http\Requests\Auth\StoreTwoFactorRequest;
use App\Traits\AuthLog;

class TwoFactorController extends Controller
{
    use AuthLog;

    /**
     * Return View Page for verify Code Two Factor.
     */
    public function verify(): View
    {
        try {
            return view('auth.two-factor');
        } catch (\Throwable $th) {
            Log::info($th->getMessage());

            abort(500);
        }
    }

    /**
     * Validate the two factor code.
     */
    public function validateTwoFactor(StoreTwoFactorRequest $request): JsonResponse
    {
        try {

            if ($request->two_factor_code == optional($request->user()->twoFactors->where('two_factor_ip', $request->ip())->first())->two_factor_code) {
                $request->user()->resetTwoFactorCode($request->ip());

                $this->setLastLogStatusTo($request->user(), 'Logged In');

                return response()->json([
                    'message' => 'Two Factor berhasil divalidasi.',
                    'redirect' => route('dashboard'),
                ]);
            }

            return response()->json([
                'message' => 'Kode Two Factor tidak valid.',
            ], 401);
        } catch (\Throwable $th) {
            info($th->getMessage());

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }

    /**
     * resend two factor code.
     */
    public function resend(Request $request)
    {
        try {
            $request->user()->sendTwoFactorNotification($request);

            return response()->json([
                'message' => 'Kode two factor authentification sudah dikirim ulang ke email',
                'redirect' => route('twofactor.verify')
            ]);
        } catch (\Throwable $th) {
            info($th->getMessage());

            abort(500);
        }
    }
}
