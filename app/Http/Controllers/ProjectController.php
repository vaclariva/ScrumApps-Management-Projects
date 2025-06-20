<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\StoreProjectRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->role === 'Superadmin') {
            $projects = Project::with('user')->latest()->get();
        } elseif ($user->role === 'ProductOwner') {
            $projects = Project::with('user')
                ->where('user_id', $user->id)
                ->latest()
                ->get();
        } elseif ($user->role === 'Team') {
            $projects = Project::with('user')
                ->whereIn('id', function ($query) use ($user) {
                    $query->select('project_id')
                        ->from('teams')
                        ->where('user_id', $user->id);
                })
                ->latest()
                ->get();
        } else {
            $projects = collect();
        }
        $users = User::where('role', 'ProductOwner')->get();
        return view('projects.index', compact('projects', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $data['status'] = $data['status'] ?? 'hold';
            $project = Project::create($data);

             Mail::to($project->user->email)->send(new \App\Mail\ProjectCreated($project));

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
                'redirect' => route('vision-boards.index', ['project_id' => $project->id]),
            ]);

        } catch (\Throwable $th) {
            info('Error:', [$th]);
            DB::rollBack();

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProjectRequest $request, Project $project)
    {
        DB::beginTransaction();

        try {
            $users = User::where('role', 'ProductOwner')->get();
            $data = $request->validated();
            $data['status'] = $data['status'] ?? 'hold';

            $project->update($data);

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
    public function destroy(Project $project)
    {
        try {
            DB::beginTransaction();

            $project->delete();

            DB::commit();

            Mail::to($project->user->email)->send(new \App\Mail\ProjectRemoved($project));

            return response()->json([
                'message' => trans('Berhasil dihapus.'),
                'redirect' => route('projects.index'),
            ]);
        } catch (\Throwable $th) {
            info($th);
            DB::rollBack();

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }
}
