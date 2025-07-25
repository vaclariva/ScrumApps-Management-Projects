<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $user = Auth::user();
        $cacheKey = "dashboard_data_{$user->id}";
        $cacheDuration = 300;

        $dashboardData = Cache::remember($cacheKey, $cacheDuration, function () use ($user) {
        if ($user->role === 'Superadmin') {
                $projectStats = Project::selectRaw('
                    COUNT(*) as total_projects,
                    SUM(CASE WHEN status = "LATE" THEN 1 ELSE 0 END) as late_projects,
                    SUM(CASE WHEN status = "DONE" THEN 1 ELSE 0 END) as done_projects,
                    SUM(CASE WHEN status = "IN PROGRESS" THEN 1 ELSE 0 END) as in_progress_projects
                ')->first();

            $holdProjects = Project::whereDoesntHave('sprints')->count();

                $projects = Project::with('user')->latest()->take(5)->get();
                $projectsAll = Project::with('user')->latest()->get();

            $hold = Project::whereDoesntHave('sprints')->get();
            $late = Project::where('status', 'LATE')->get();
            $done = Project::where('status', 'DONE')->get();
            $inProgress = Project::where('status', 'IN PROGRESS')->get();

        } else {
                $userProjectIds = DB::table('projects')
                    ->select('id')
                    ->where('user_id', $user->id)
                    ->union(
                        DB::table('teams')
                            ->select('project_id as id')
                            ->where('user_id', $user->id)
                    )
                    ->pluck('id')
                    ->unique()
                    ->values()
                    ->toArray();

                if (empty($userProjectIds)) {
                    return [
                        'projects' => collect(),
                        'projectsAll' => collect(),
                        'totalProjects' => 0,
                        'holdProjects' => 0,
                        'lateProjects' => 0,
                        'doneProjects' => 0,
                        'inProgressProjects' => 0,
                        'hold' => collect(),
                        'late' => collect(),
                        'done' => collect(),
                        'inProgress' => collect(),
                    ];
                }

                $projectStats = Project::whereIn('id', $userProjectIds)
                    ->selectRaw('
                        COUNT(*) as total_projects,
                        SUM(CASE WHEN status = "LATE" THEN 1 ELSE 0 END) as late_projects,
                        SUM(CASE WHEN status = "DONE" THEN 1 ELSE 0 END) as done_projects,
                        SUM(CASE WHEN status = "IN PROGRESS" THEN 1 ELSE 0 END) as in_progress_projects
                    ')->first();

                $holdProjects = Project::whereIn('id', $userProjectIds)
                    ->whereDoesntHave('sprints')
                    ->count();

                $projects = Project::with('user')
                    ->whereIn('id', $userProjectIds)
                    ->latest()
                    ->take(5)
                    ->get();

                $projectsAll = Project::with('user')
                    ->whereIn('id', $userProjectIds)
                    ->latest()
                    ->get();

                $hold = Project::whereIn('id', $userProjectIds)
                    ->whereDoesntHave('sprints')
                    ->get();
                $late = Project::whereIn('id', $userProjectIds)
                    ->where('status', 'LATE')
                    ->get();
                $done = Project::whereIn('id', $userProjectIds)
                    ->where('status', 'DONE')
                    ->get();
                $inProgress = Project::whereIn('id', $userProjectIds)
                    ->where('status', 'IN PROGRESS')
                    ->get();
            }

            return [
                'projects' => $projects,
                'projectsAll' => $projectsAll,
                'totalProjects' => $projectStats->total_projects ?? 0,
                'holdProjects' => $holdProjects,
                'lateProjects' => $projectStats->late_projects ?? 0,
                'doneProjects' => $projectStats->done_projects ?? 0,
                'inProgressProjects' => $projectStats->in_progress_projects ?? 0,
                'hold' => $hold,
                'late' => $late,
                'done' => $done,
                'inProgress' => $inProgress,
            ];
        });

        return view('dashboard.index', $dashboardData);
    }
}
