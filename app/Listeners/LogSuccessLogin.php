<?php

namespace App\Listeners;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\AuthenticationLog;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Cookie;

class LogSuccessLogin
{
    /**
     * The request.
     *
     * @var \Illuminate\Http\Request
     */
    public $request;

    /**
     * Create the event listener.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user = $event->user;
        $userAgent = $this->request->userAgent();
        $os = preg_split('/\s*[;)(]\s*/', $userAgent);

        if (!$this->ifLoginUsingRememberMe()) {
            AuthenticationLog::create([
                'user_id' => $user->id,
                'email' => $user->email,
                'remember_me' => $this->request->remember ?? 0,
                'ip_address' => $this->request->ip(),
                'session_id' => session()->getId(),
                'guard' => $event->guard,
                'user_agent' => $userAgent,
                'os' => array_key_exists(2, $os) ? $os[2] : null,
                'login_at' => Carbon::now(),
                'login_status' => 'Logged In'
            ]);

            Cookie::queue(Cookie::forever('session_id', session()->getId()));
        }

    }

    /**
     * Memeriksa proses login apakah melalui remember me
     *
     * @return boolean
     */
    protected function ifLoginUsingRememberMe()
    {
        if (!Cookie::has('session_id')) {
            return false;
        }

        $auth_log = AuthenticationLog::where('session_id', Cookie::get('session_id'))->first();

        if ($auth_log) {
            $auth_log->session_id = session()->getId();
            $auth_log->save();
            Cookie::queue(Cookie::forget('session_id'));
            Cookie::queue(Cookie::forever('session_id', session()->getId()));
            return true;
        }

        return false;
    }
}
