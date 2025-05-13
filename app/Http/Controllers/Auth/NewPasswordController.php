<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\Auth\StorePasswordRequest;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(StorePasswordRequest $request)
    {
        $validated = $request->validated();

        if($validated['is_weak_password'] && ! isset($request->checklist_weak_password)){
            return response()->json([
                'message' => "Centang 'Gunakan kata sandi meskipun lemah' untuk menggunakan kata sandi lemah.",
            ], 400);
        }
        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            Arr::only($validated, ['email', 'password', 'password_confirmation', 'token']),
            function ($user) use ($validated) {
                $user->forceFill([
                    'password' => Hash::make($validated['password']),
                    'remember_token' => Str::random(60),
                    'is_weak_password' => $validated['is_weak_password']
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status == Password::PASSWORD_RESET
                    ? response()->json([
                        'message' => trans($status),
                        'redirect' => route('login'),
                    ])
                    : response()->json([
                        'message' => trans($status),
                    ], 500);
    }
}
