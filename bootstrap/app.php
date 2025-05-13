<?php

use App\Exceptions\Handler;
use App\Http\Middleware\Auth\IsActive;
use Illuminate\Foundation\Application;
use App\Http\Middleware\Auth\TwoFactor;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use App\Http\Middleware\BannedIpMiddleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth.twofactor' => TwoFactor::class,
            'auth.is_active' => IsActive::class,
            'banned.ip' => BannedIpMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions)  {
        $exceptions->render(function (Throwable $e, $request) {
            /**
             * Handling Authorization Exception.
             */
            if ($e instanceof AuthorizationException) {

                if ($request->ajax()) {
                    return response()->json([
                        'message' => trans('This action is unauthorized.'),
                    ], 403);
                }
                if (!$request->routeIs('error.page.preview')) {
                    return redirect()->route('error.page.preview', 403);
                }
            }

            /**
             * Handling Authentication Exception.
             */
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

            /**
             * Handling Token Mismatch Exception.
             */
            if ($e instanceof TokenMismatchException) {
                if ($request->ajax()) {
                    return response()->json([
                        'status' => 'session_expired',
                        'message' => trans('auth.expired'),
                    ], 419);
                }

                return redirect()->route('login')->withErrors(trans('auth.expired'));
            }

            /**
             * Handling PDO Exception.
             */
            if ($e instanceof PDOException) {
                if ($request->ajax()) {
                    return response()->json([
                        'message' => trans('Error Establishing a Database Connection'),
                    ], 503);
                }

                return response()->view('errors.database-not-found', [], 503);

            }

            if ($e instanceof QueryException) {
                    if ($request->ajax()) {
                    return response()->json([
                        'message' => trans('Error Establishing a Database Connection'),
                    ], 503);
                }

                return response()->view('errors.database-not-found', [], 503);
            }

            /**
             * Handling Validation Exception.
             */
            if ($e instanceof ValidationException) {
                if ($request->ajax()) {
                    /**
                     * Handling Authorization Validation.
                     */
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

                    /**
                     * Fallback Handling for Other Validation.
                     */
                    return response()->json([
                        'message' => $e->getMessage(),
                        'errors' => collect($e->errors())->unique()->toArray(),
                    ], 422);
                }

                return redirect()->back()->withErrors($e->errors());
            }

            /**
             * Handling Transport (Notification) Exception.
             */
            if ($e instanceof TransportException) {
                if ($request->ajax()) {
                    return response()->json([
                        'message' => 'Email host belum diatur.',
                    ], 500);
                }
                if (!$request->routeIs('error.page.preview')) {
                    return redirect()->route('error.page.preview', 500);
                }
            }

            /**
             * Handling Not Found HTTP Exception.
             */
            if ($e instanceof NotFoundHttpException) {
                if ($request->ajax()) {
                    return response()->json([
                        'message' => trans('http-statuses.404'),
                    ], 404);
                }

                 // Mencegah redirect infinite loop
                if (!$request->routeIs('error.page.preview')) {
                    return redirect()->route('error.page.preview', 404);
                }

            }

            /**
             * Handling Method Not Allowed Exception.
             */
            if ($e instanceof MethodNotAllowedException && $e instanceof MethodNotAllowedHttpException) {
                if ($request->ajax()) {
                    return response()->json([
                        'message' => trans('http-statuses.405'),
                    ], 405);
                }

                if (!$request->routeIs('error.page.preview')) {
                    return redirect()->route('error.page.preview', 405);
                }
            }

            if ($e instanceof ThrottleRequestsException) {
                return response()->json([
                    'message' => 'Terlalu banyak permintaan. <br/> Mohon tunggu beberapa saat lagi.'
                ], 429);
            }

            redirect()->back()->with('error', $e->getMessage());
        });

    })->create();
