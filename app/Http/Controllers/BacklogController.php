<?php

namespace App\Http\Controllers;

use App\Http\Requests\Backlog\StoreBacklogRequest;
use App\Http\Requests\CheckBacklog\StoreCheckBacklogRequest;
use App\Models\Backlog;
use App\Models\CheckBacklog;
use App\Models\Project;
use App\Models\Sprint;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BacklogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
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

        return view('backlogs.index', compact('users','project', 'backlogs', 'sprints', 'checkBacklogs'));
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
     * Duplicate the specified resource in storage.
     */
    public function duplicate(StoreBacklogRequest $request)
    {
        DB::beginTransaction();

        try {
            // Validasi data backlog
            $validatedBacklog = $request->validated();

            // Tambahkan '-copy' pada nama backlog yang diduplikasi
            $validatedBacklog['name'] = $validatedBacklog['name'] . '-copy';

            // Buat backlog baru dengan data yang sudah diperbarui
            $newBacklog = Backlog::create($validatedBacklog);

            // Cek jika ada data checkBacklog
            if ($request->has('check_backlog')) {
                // Ambil data checkBacklog
                $checkBacklogRequest = app()->make(StoreCheckBacklogRequest::class);
                $checkData = $checkBacklogRequest->validated();

                // Ganti backlog_id ke ID yang baru dibuat
                $checkData['backlog_id'] = $newBacklog->id;

                // Simpan checkBacklog
                CheckBacklog::create($checkData);
            }

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
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
