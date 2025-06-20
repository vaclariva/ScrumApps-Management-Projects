<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NotifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function read(Project $project)
    {
        $user = auth()->user();

        DB::table('project_user_reads')->updateOrInsert(
            [
                'user_id' => $user->id,
                'project_id' => $project->id
            ],
            [
                'read' => true,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        $isSuperAdmin = $user->role === 'superadmin';

        $projects = Project::whereIn('status', ['DONE', 'LATE'])
            ->where(function ($query) use ($user, $isSuperAdmin) {
                if ($isSuperAdmin) {
                    $query->whereNotIn('id', function ($subQuery) use ($user) {
                        $subQuery->select('project_id')
                            ->from('project_user_reads')
                            ->where('user_id', $user->id)
                            ->where('read', true);
                    });
                } else {
                    $query->where(function ($subQuery) use ($user) {
                        $subQuery->where('user_id', $user->id)
                            ->orWhereIn('id', function ($teamQuery) use ($user) {
                                $teamQuery->select('project_id')
                                    ->from('teams')
                                    ->where('user_id', $user->id);
                            });
                    })
                    ->whereNotIn('id', function ($subQuery) use ($user) {
                        $subQuery->select('project_id')
                            ->from('project_user_reads')
                            ->where('user_id', $user->id)
                            ->where('read', true);
                    });
                }
            })
            ->get();

        $unreadCount = $projects->count();

        Log::info('Unread notification count for user ' . $user->id . ' (Role: ' . $user->role . '): ' . $unreadCount);

        return response()->json([
            'unreadCount' => $unreadCount,
        ]);
    }
}
