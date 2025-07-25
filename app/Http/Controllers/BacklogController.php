<?php

namespace App\Http\Controllers;

use App\Http\Requests\Backlog\StoreBacklogRequest;
use App\Http\Requests\CheckBacklog\StoreCheckBacklogRequest;
use App\Models\Backlog;
use App\Models\CheckBacklog;
use App\Models\Project;
use App\Models\Sprint;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BacklogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $activeIndex = $request->query('tab', 0);
        $projects = Project::with('user')->get();
        $users = User::where('role', 'ProductOwner')->get();
        $projectId = $request->query('project_id');
        $checkBacklogs = CheckBacklog::all();
        $sprints = Sprint::all();
        $backlogs = Backlog::with('sprint')->get();

        if (!$projectId) {
            abort(404, 'Project ID tidak ditemukan');
        }

        $project = Project::findOrFail($projectId);
        $sprints = Sprint::where('project_id', $projectId)->get();
        $backlogs = Backlog::where('project_id', $projectId)
        ->latest()
        ->get();

        return view('backlogs.index', compact('users','project', 'backlogs', 'sprints', 'checkBacklogs', 'activeIndex'));
    }

     /**
     * Display a listing of backlogs grouped by sprint.
     */
    public function sprintGrouped(Request $request)
    {
        $activeIndex = 1;
        $projectId = $request->query('project_id');
        if (!$projectId) {
            abort(404, 'Project ID tidak ditemukan');
        }

        $project = Project::findOrFail($projectId);
        $users = User::where('role', 'ProductOwner')->get();
        $backlogs = Backlog::where('project_id', $projectId)
        ->latest()
        ->get();
        $sprints = Sprint::where('project_id', $projectId)->get();
        $checkBacklogs = CheckBacklog::all();

        // Kelompokkan backlog berdasarkan sprint
        $backlogsGrouped = Backlog::where('project_id', $projectId)
            ->with('sprint')
            ->latest()
            ->get()
            ->groupBy(function ($backlog) {
                return $backlog->sprint ? $backlog->sprint->name : 'Belum memiliki Sprint';
            });

        return view('backlogs.backlog-grouped', compact('users', 'project', 'backlogsGrouped', 'sprints', 'checkBacklogs', 'backlogs', 'activeIndex'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBacklogRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $data['status'] = $data['status'] ?? 'inactive';
            $backlog = Backlog::create($data)->load('project.user');

            DB::commit();

            $backlogHtml = view('backlogs.partials.backlogs-card', [
                'backlog' => $backlog,
                'project' => $backlog->project,
            ])->render();
            return response()->json([
                'message' => trans('http-statuses.201'),
                'backlog' => $backlog,
                'project' => [
                    'user' => [
                        'name' => $backlog->project?->user?->name,
                        'photo_path' => $backlog->project?->user?->photo_path,
                    ],
                ],
                'html' => view('backlogs.partials.backlogs-card', [
                    'backlog' => $backlog,
                    'project' => $backlog->project,
                ])->render(),
                'backlog_id' => $backlog->id,
                'check_backlogs' => $backlog->checkBacklogs,
            ]);

        } catch (\Throwable $th) {
            info('Store Error:', [$th]);
            DB::rollBack();

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $backlog = Backlog::findOrFail($id);
        return response()->json($backlog);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBacklogRequest $request, Backlog $backlog)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $backlog->update($data);
            $project = $backlog->project()->with('user')->first();

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
                'redirect' => url()->previous(),
                'backlog' => $backlog,
                'project' => $project,
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
     * Duplicate the specified resource in storage.
     */
    public function duplicate(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $original = Backlog::findOrFail($id);

            $newBacklog = $original->replicate();
            $newBacklog->name = $original->name . ' - copy';
            $newBacklog->save();

            if ($original->checkBacklog) {
                $newCheck = $original->checkBacklog->replicate();
                $newCheck->backlog_id = $newBacklog->id;
                $newCheck->save();
            }

            DB::commit();

            return response()->json([
                'message' => 'Backlog berhasil diduplikat.',
                'redirect' => url()->previous(),
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            info('Duplicate Error:', [$th]);

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }

    public function downloadPdf($id)
    {
        $backlog = Backlog::with('user', 'checkBacklogs', 'project')->findOrFail($id);

        $data = [
            'productName' => $backlog->project->name ?? '-',
            'applicant' => $backlog->applicant ?? '-',
            'hariTanggal' => \Carbon\Carbon::parse($backlog->created_at)->translatedFormat('l, d F Y'),
            'userStory' => $backlog->name,
            'acceptanceCriteria' => $backlog->checkBacklogs,
            'keterangan' => $backlog->description ?? '-',
            'backlog' => $backlog,
        ];

        $pdf = Pdf::loadView('backlogs.partials.backlogs-pdf', $data)
                ->setPaper('a4', 'portrait');

        $filename = 'Backlog_' . str_replace(' ', '_', $backlog->name) . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Backlog $backlog)
    {
        try {
            DB::beginTransaction();

            $backlog->delete();

            DB::commit();

            return response()->json([
                'message' => trans('Berhasil dihapus.'),
                'redirect' => url()->previous(),
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
