<?php

namespace App\Traits;

use App\Models\AuthenticationLog;

trait AuthLog
{
    /**
     * Set status log ke failed
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @param string $status
     *
     * @return void
     */
    public function setLastLogStatusTo($user, $status)
    {
        $authenticationLog = AuthenticationLog::where([
            'guard' => 'web',
            'user_id' => $user->id
        ])->latest()->first();

        $authenticationLog->login_status = $status;
        $authenticationLog->save();
    }
}
