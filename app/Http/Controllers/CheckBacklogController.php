<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckBacklog\StoreCheckBacklogRequest;
use App\Models\Backlog;
use App\Models\CheckBacklog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckBacklogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($backlogId)
    {
        $backlog    = Backlog::findOrFail($backlogId);
        $checkBacklog = CheckBacklog::where('backlog_id', $backlogId)->get();

        return view('pages.vision-boards.detail-product', compact('backlog', 'checkBacklog'));
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
    public function store(StoreCheckBacklogRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $data['status'] = $data['status'] ?? 'inactive';
            $checkBacklog = CheckBacklog::create($data);
            $checkBacklog->load('backlog.checkBacklogs');

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
                'redirect' => url()->previous(),
                'check_backlogs' => $checkBacklog->backlog->checkBacklogs,
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
    public function update(StoreCheckBacklogRequest $request, CheckBacklog $checkBacklog)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $checkBacklog->update($data);

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
    public function destroy(string $id)
    {
        //
    }
}
