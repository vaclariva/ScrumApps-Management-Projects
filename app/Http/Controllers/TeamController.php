<?php

namespace App\Http\Controllers;

use App\Http\Requests\Team\StoreTeamRequest;
use App\Models\Project;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $projects = Project::with('user')->get();
        $users = User::where('role', 'TeamDeveloper')->get();
        $projectId = $request->query('project_id');

        if (!$projectId) {
            abort(404, 'Project ID tidak ditemukan');
        }

        $project = Project::findOrFail($projectId);
        $teams = Team::where('project_id', $projectId)
        ->latest()
        ->get();

        return view('teams.index', compact('users','project', 'teams'));
    }

    /**
    * Define datatable instance of teams.
    */
    public function list(Request $request, Project $project)
    {
        try {
            $id = $project->id;
            $teamsQuery = Team::join('users', 'users.id', '=', 'teams.user_id')
                  ->select('teams.*', 'users.name as user_name', 'teams.role as team_role')
                  ->where('teams.project_id', $id);

            return DataTables::of($teamsQuery)
                ->addIndexColumn()
                ->editColumn('name', function (Team $team) use ($id) {
                    return view('teams.partials.datatable-name', [
                        'product' => $id,
                        'team' => $team,
                        'name' => $team->user->name ?? '-',
                    ]);
                })
                ->editColumn('role', function (Team $team) {
                    return view('teams.partials.datatable-role', [
                        'team' => $team,
                        'role' => $team->role ?? '-']);
                })
                ->addColumn('actions', function (Team $team) {
                    return view('teams.partials.datatable-actions', ['url_delete' => route('teams.destroy', $team->id)]);
                })
                ->order(function ($query) use ($request) {
                    $orderRequest = $request->input('order');
                    if ($orderRequest) {
                        $order = $orderRequest[0];
                        $dir = $order['dir'] ?? 'asc';

                        switch ($order['column']) {
                            case 0:
                                $query->latest('teams.created_at');
                                break;
                            case 1:
                                $query->orderBy('users.name', $dir);
                                break;
                            case 2:
                                $query->orderBy('teams.role', $dir);
                                break;
                            default:
                                $query->latest('teams.created_at');
                        }
                    } else {
                        $query->latest('teams.created_at');
                    }
                })
                ->filter(function ($query) use ($request) {
                    $search = $request->input('search.value');
                    if ($search) {
                        $query->where(function ($q) use ($search) {
                            $q->where('users.name', 'like', '%' . $search . '%')
                                ->orWhere('teams.role', 'like', '%' . $search . '%');
                        });
                    }
                })
                ->make(true);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            $exists = Team::where('user_id', $data['user_id'])
                ->where('project_id', $data['project_id'])
                ->exists();

            if ($exists) {
                return response()->json([
                    'message' => 'Pengguna sudah terdaftar dalam proyek ini.',
                ], 409);
            }

            $team = Team::create($data);
            Log::info('User yang akan dikirimi email:', [$team->user]);

            Mail::to($team->user->email)->send(new \App\Mail\TeamMemberAdded($team));

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
                'redirect' => url()->previous(),
            ]);
        } catch (\Throwable $th) {
            Log::error('Error saat store team:', [
                'error_message' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
                'line' => $th->getLine(),
                'file' => $th->getFile(),
                'previous' => $th->getPrevious(),
                'request_data' => $request->all(),
            ]);
            DB::rollBack();

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTeamRequest $request, Team $team)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $team->update($data);

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
                'redirect' => url()->previous(),
            ]);
        } catch (\Throwable $th) {
            info('Update Error:', [$th]);
            DB::rollBack();

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        DB::beginTransaction();

        try {
            $team->delete();

            DB::commit();

            Mail::to($team->user->email)->send(new \App\Mail\TeamMemberRemoved($team));

            return response()->json([
                'message' => trans('Berhasil dihapus.'),
                'redirect' => url()->previous(),
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }
}
