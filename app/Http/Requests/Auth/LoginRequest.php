<?php

namespace App\Http\Requests\Auth;


use App\Models\BannedIp;
use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'exists:users,email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     */
    public function attributes(): array
    {
        return [
            'email' => 'email',
            'password' => 'kata sandi',
        ];
    }


    /**
     * Get the custom message that apply to the request errors.
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Harap masukkan :attribute Anda.',
            'password.required' => 'Harap masukkan :attribute Anda.',
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        /**
         * Ensure user is not blocked.
         */
       // if (Auth::user()->blocked) {
       //     Auth::guard('web')->logout();

       //     throw ValidationException::withMessages([
       //         'email' => trans('auth.banned'),
       //     ]);
       // }

        /**
         * Ensure user ip is not banned.
         */
        if (BannedIp::where('ip_address', request()->ip())->exists()) {
            Auth::guard('web')->logout();

            throw ValidationException::withMessages([
                'email' => trans('auth.ip-banned'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {

        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 4)) {

            request()->session()->forget('throttled');
            if (Cookie::has('throttle-end')) {
                Cookie::forget('throttle-end');
            }
            if (Cookie::has('login-status')) {
                Cookie::forget('login-status');

                info('hapus');
            }
            return;
        }

        $seconds = RateLimiter::availableIn($this->throttleKey());

        setcookie('throttle-end', now()->addSeconds($seconds), time() + $seconds);
        setcookie('login-status', 'throttle', time() + $seconds);


        $this->ensureIsNotBanned();

        event(new Lockout($this));

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle-login'),
        ]);
    }

    public function ensureIsNotBanned(): void
    {
        info('has trottle : '.(int) request()->session()->has('throttled'));
        if (RateLimiter::tooManyAttempts($this->throttleKey(), 4) && request()->session()->has('throttled')) {
            User::where('email', request()->email)->update([
                'blocked' => true,
                'blocked_at' => now()
            ]);

            BannedIp::create([
                'ip_address' => request()->ip(),
            ]);

            request()->session()->forget('throttled');

            throw ValidationException::withMessages([
                'email' => trans('auth.ip-banned'),
            ])->status(419);
        } else {
            request()->session()->put('throttled', $this->throttleKey());
        }
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')).'|'.$this->ip());
    }
}
