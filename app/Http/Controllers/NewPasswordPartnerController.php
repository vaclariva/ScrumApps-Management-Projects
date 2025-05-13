<?php

namespace App\Http\Controllers;

use App\Http\Requests\Partner\StorePasswordRequest;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;

class NewPasswordPartnerController extends Controller
{
    public function create(Request $request)
    {
        return view('auth.reset-password-partner', ['request' => $request]);
    }

    public function store(StorePasswordRequest $request)
    {
        $validated = $request->validated();
        info($validated);

        if ($validated['is_weak_password'] && ! isset($request->checklist_weak_password)) {
            return response()->json([
                'message' => "Centang 'Gunakan kata sandi meskipun lemah' untuk menggunakan kata sandi lemah.",
            ], 400);
        }
        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $partner = Partner::where('email', $validated['email'])->first();
        $status = $partner->update([
            'password' => Hash::make($validated['password']),
            'remember_token' => Str::random(60),
            'is_weak_password' => $validated['is_weak_password']
        ]);

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status
            ? response()->json([
                'message' => trans($status),
                'redirect' => route('login'),
            ])
            : response()->json([
                'message' => trans($status),
            ], 500);
    }

    public function resend(Request $request, Partner $partner)
    {
        try{
            $partner->sendCreatePasswordNotification();
            return response()->json([
                'message' => trans('passwords.sent'),
            ], 201);
        }
        catch(\Throwable $th){
            info($th);
            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }
}
