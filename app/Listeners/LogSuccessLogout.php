<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\AuthenticationLog;
use Illuminate\Support\Facades\Cookie;

class LogSuccessLogout
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
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        if ($event->user) {
            $user = $event->user;
            $userAgent = $this->request->userAgent();
            $authenticationLog = AuthenticationLog::where([
                'session_id' => Cookie::get('session_id')
            ])->latest()->first();

            if (!$authenticationLog) {
                $authenticationLog = new AuthenticationLog([
                    'guard' => $event->guard,
                    'ip_address' => $this->request->ip(),
                    'user_id' => $user->id,
                    'user_agent' => $userAgent,
                ]);
            }

            $authenticationLog->logout_at = now();
            $authenticationLog->duration = Carbon::parse($authenticationLog->login_at)->diffAsCarbonInterval();
            $authenticationLog->login_status = 'Logged Out';

            $authenticationLog->save();

            Cookie::queue(Cookie::forget('session_id'));

        }
    }
}
