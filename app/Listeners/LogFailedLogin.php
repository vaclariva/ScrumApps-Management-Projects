<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Failed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\AuthenticationLog;
use App\Models\User;

class LogFailedLogin
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
     * @param  object  $event
     * @return void
     */
    public function handle(Failed $event)
    {
        $userAgent = $this->request->userAgent();
        $os = preg_split('/\s*[;)(]\s*/', $userAgent);

        $authenticationLog = new AuthenticationLog([
            'email' => $this->existEmail(),
            'ip_address' => $this->request->ip(),
            'guard' => $event->guard,
            'user_agent' => $userAgent,
            'login_status' => 'Failed',
            'os' => array_key_exists(2, $os) ? $os[2] : null,
        ]);

        $authenticationLog->save();
    }

    /**
     * Check apakah email ada di db
     *
     * @return string
     */
    protected function existEmail()
    {
        $log = User::where('email', $this->request->email);
        if ($log->exists()) {
            return $log->first()->email;
        }

        return "-";
    }
}
