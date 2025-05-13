<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NotifController extends Controller
{
    /**
     * Display a listing of the resource.
     */


public function read(Project $project)
{
    $project->update(['read' => true]);

    $user = auth()->user();
    $isSuperAdmin = $user->role === 'superadmin';

    $projects = Project::where(function ($query) use ($user, $isSuperAdmin) {
        if ($isSuperAdmin) {
            $query->where('read', 0)
                ->whereIn('status', ['done', 'late']);
        } else {
            $query->where(function ($subQuery) use ($user) {
                $subQuery->where('user_id', $user->id);

                $subQuery->orWhereIn('id', function ($teamQuery) use ($user) {
                    $teamQuery->select('project_id')
                        ->from('teams')
                        ->where('user_id', $user->id);
                });
            })
            ->where('read', 0)
            ->whereIn('status', ['done', 'late']);
        }
    })->get();

    Log::info('Proyek ditemukan:', $projects->toArray());

     $unreadCount = Project::where('read', 0)
        ->whereIn('status', ['done', 'late'])
        ->count();


    Log::info('Unread notification count for user ' . $user->id . ' (Role: ' . $user->role . '): ' . $unreadCount);

    return response()->json([
        'unreadCount' => $unreadCount,
    ]);
}

}
