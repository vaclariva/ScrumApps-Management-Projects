<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'Superadmin') {
            $projects = Project::latest()->take(5)->get();
            $projectsAll = Project::latest()->get();
            $totalProjects = Project::count();
            $holdProjects = Project::whereDoesntHave('sprints')->count();
            $lateProjects = Project::where('status', 'LATE')->count();
            $doneProjects = Project::where('status', 'DONE')->count();
            $inProgressProjects = Project::where('status', 'IN PROGRESS')->count();
            $hold = Project::whereDoesntHave('sprints')->get();
            $late = Project::where('status', 'LATE')->get();
            $done = Project::where('status', 'DONE')->get();
            $inProgress = Project::where('status', 'IN PROGRESS')->get();
        } else {
            $ownerProjects = Project::where('user_id', $user->id)->pluck('id')->toArray();

            $memberProjects = Team::where('user_id', $user->id)->pluck('project_id')->toArray();

            $allProjectIds = array_unique(array_merge($ownerProjects, $memberProjects));

            $projects = Project::whereIn('id', $allProjectIds)->latest()->take(5)->get();
            $projectsAll = Project::whereIn('id', $allProjectIds)->latest()->get();

            $totalProjects = Project::whereIn('id', $allProjectIds)->count();
            $holdProjects = Project::whereIn('id', $allProjectIds)->whereDoesntHave('sprints')->count();
            $lateProjects = Project::whereIn('id', $allProjectIds)->where('status', 'LATE')->count();
            $doneProjects = Project::whereIn('id', $allProjectIds)->where('status', 'DONE')->count();
            $inProgressProjects = Project::whereIn('id', $allProjectIds)->where('status', 'IN PROGRESS')->count();
            $hold = Project::whereDoesntHave('sprints')->get();
            $late = Project::where('status', 'LATE')->get();
            $done = Project::where('status', 'DONE')->get();
            $inProgress = Project::where('status', 'IN PROGRESS')->get();
        }

        return view('dashboard.index', compact(
            'projects',
            'projectsAll',
            'totalProjects',
            'holdProjects',
            'lateProjects',
            'doneProjects',
            'inProgressProjects',
            'hold',
            'late',
            'done',
            'inProgress',
        ));
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
