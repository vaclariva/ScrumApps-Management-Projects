<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\BannedIp;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BannedIpMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            if (BannedIp::where('ip_address', $request->ip())->exists()) {
                return redirect()->route('ip.banned');
            }

            return $next($request);
        } catch (\Throwable $th) {
            info($th);

            return redirect()->route('ip.banned');
        }
    }
}
