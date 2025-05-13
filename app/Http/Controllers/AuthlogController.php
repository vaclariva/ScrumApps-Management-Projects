<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\AuthenticationLog;
use Illuminate\Database\Eloquent\Builder;

class AuthlogController extends Controller
{
    /**
     * Menampilkan halaman authlog
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        // Permission check.
        if (! auth()->user()->is_superadmin) {
            abort(403);
        }

        return view('authlog.index');
    }

    /**
     * Data authentication log
     */
    public function list(Request $request)
    {
        try {
            // Permission check
            if (! auth()->user()->is_superadmin) {
                abort(403);
            }

            $order = $request->input('order')[0];

            return DataTables::of(
                AuthenticationLog::query()
                    ->when($order['column'] == 0, fn(Builder $query) => $query->latest())
            )
                ->addIndexColumn()
                ->addColumn('last_seen', fn(AuthenticationLog $authenticationLog) => $authenticationLog->login_at ? Carbon::parse($authenticationLog->login_at)->diffForHumans() : '-')
                ->editColumn('login_at', fn(AuthenticationLog $authenticationLog) => $authenticationLog->login_at ? Carbon::parse($authenticationLog->login_at)->format('d F Y \j\a\m H:i:s') : '-')
                ->editColumn('logout_at', fn(AuthenticationLog $authenticationLog) => $authenticationLog->logout_at ? Carbon::parse($authenticationLog->logout_at)->format('d F Y \j\a\m H:i:s') : '-')
                ->editColumn('email', fn (AuthenticationLog $authenticationLog) => $authenticationLog->email ? $authenticationLog->email : '-')
                ->editColumn('user_agent', fn (AuthenticationLog $authenticationLog) => $authenticationLog->user_agent ? $authenticationLog->user_agent : '-')
                ->editColumn('os', fn (AuthenticationLog $authenticationLog) => $authenticationLog->os ? $authenticationLog->os : '-')
                ->editColumn('duration', fn (AuthenticationLog $authenticationLog) => $authenticationLog->duration ? $authenticationLog->duration : '-')
                ->editColumn('login_status', fn (AuthenticationLog $authenticationLog) => view('authlog.partials.datatable-status', ['status' => $authenticationLog->login_status]))
                ->make(true);
        } catch (\Throwable $th) {
            info($th);

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }

    /**
     * Mengambil nama browser dari user agent
     *
     * @param  mixed $user_agent
     * @return mixed
     */
    protected function getBrowserName($user_agent)
    {
        try {
            $array_data = get_browser($user_agent);

            return optional($array_data)->browser;
        } catch (\Throwable $th) {
            return $user_agent;
        }
    }

    /**
     * Create link to edit user
     *
     * @param  mixed $user
     * @return string
     */
    protected function userLink($user)
    {
        if (!$user) {
            return "";
        }

        $route = "";

        if ($user->hasRole('Superuser')) {
            $route = route('setting.myProfile');
        } else {
            $route = route('user.edit', $user->id);
        }

        return "<a href='{$route}'>{$user->name}</a>";
    }
}
