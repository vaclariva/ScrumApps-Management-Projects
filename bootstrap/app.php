<?php

use App\Exceptions\Handler;
use App\Http\Middleware\Auth\IsActive;
use App\Http\Middleware\Auth\TwoFactor;
use App\Http\Middleware\BannedIpMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Database\QueryException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth.twofactor' => TwoFactor::class,
            'auth.is_active' => IsActive::class,
            'banned.ip' => BannedIpMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $e, $request) {
            if ($e instanceof AuthorizationException) {
                if ($request->ajax()) {
                    return response()->json(['message' => trans('This action is unauthorized.')], 403);
                }
                if (!$request->routeIs('error.page.preview')) {
                    return redirect()->route('error.page.preview', 403);
                }
            }

            if ($e instanceof AuthenticationException) {
                if ($request->ajax()) {
                    return response()->json([
                        'message' => trans('auth.expired'),
                        'redirect' => route('login'),
                    ], 401);
                }

                if (Cookie::get('status') === 'admin') {
                    Cookie::queue(Cookie::forget('status'));
                    return redirect()->guest(route('login'))->withErrors(trans('auth.expired'));
                }

                return redirect()->guest(route('login'));
            }

            if ($e instanceof TokenMismatchException) {
                if ($request->ajax()) {
                    return response()->json([
                        'status' => 'session_expired',
                        'message' => trans('auth.expired'),
                    ], 419);
                }
                return redirect()->route('login')->withErrors(trans('auth.expired'));
            }

            if ($e instanceof PDOException || $e instanceof QueryException) {
                if ($request->ajax()) {
                    return response()->json([
                        'message' => trans('Error Establishing a Database Connection'),
                    ], 503);
                }
                return response()->view('errors.database-not-found', [], 503);
            }

            if ($e instanceof ValidationException) {
                if ($request->ajax()) {
                    if ($e->getMessage() == trans('auth.banned')) {
                        Session::flash('is_banned', trans('auth.banned'));
                        return response()->json([
                            'message' => 'Mengalihkan ..',
                            'redirect' => route('login'),
                        ], 401);
                    } elseif ($e->getMessage() == trans('auth.ip-banned')) {
                        return response()->json([
                            'message' => trans('auth.ip-banned'),
                            'redirect' => route('ip.banned'),
                        ], 401);
                    } elseif ($e->getMessage() == trans('auth.throttle-login')) {
                        return response()->json([
                            'message' => trans('auth.throttle-login'),
                            'redirect' => route('login'),
                        ], 401);
                    }

                    return response()->json([
                        'message' => $e->getMessage(),
                        'errors' => collect($e->errors())->unique()->toArray(),
                    ], 422);
                }

                return redirect()->back()->withErrors($e->errors());
            }

            if ($e instanceof TransportException) {
                if ($request->ajax()) {
                    return response()->json(['message' => 'Email host belum diatur.'], 500);
                }
                if (!$request->routeIs('error.page.preview')) {
                    return redirect()->route('error.page.preview', 500);
                }
            }

            if ($e instanceof NotFoundHttpException) {
                if ($request->ajax()) {
                    return response()->json(['message' => trans('http-statuses.404')], 404);
                }
                if (!$request->routeIs('error.page.preview')) {
                    return redirect()->route('error.page.preview', 404);
                }
            }

            if ($e instanceof MethodNotAllowedException || $e instanceof MethodNotAllowedHttpException) {
                if ($request->ajax()) {
                    return response()->json(['message' => trans('http-statuses.405')], 405);
                }
                if (!$request->routeIs('error.page.preview')) {
                    return redirect()->route('error.page.preview', 405);
                }
            }

            if ($e instanceof ThrottleRequestsException) {
                return response()->json([
                    'message' => 'Terlalu banyak permintaan. <br/> Mohon tunggu beberapa saat lagi.',
                ], 429);
            }

            return redirect()->back()->with('error', $e->getMessage());
        });
    })
    ->create();

// 🔧 Tambahkan binding manual Kernel di sini
$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

return $app;
