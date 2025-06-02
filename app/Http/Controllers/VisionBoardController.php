<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisionBoard\StoreVisionBoardRequest;
use App\Models\Project;
use App\Models\User;
use App\Models\VisionBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisionBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $projects = Project::with('user')->get();
        $users = User::where('role', 'ProductOwner')->get();
        $projectId = $request->query('project_id');

        if (!$projectId) {
            abort(404, 'Project ID tidak ditemukan');
        }

        $project = Project::findOrFail($projectId);
        $visionBoards = VisionBoard::where('project_id', $projectId)
        ->latest()
        ->get();

        return view('vision-boards.index', compact('users','project', 'visionBoards'));
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
    public function store(StoreVisionBoardRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $visionBoard = VisionBoard::create($data);

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
     * Display the specified resource.
     */
    public function show(VisionBoard $visionBoard)
    {
        return response()->json($visionBoard);
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
    public function update(StoreVisionBoardRequest $request, VisionBoard $visionBoard)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $visionBoard->update($data);

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
    * Duplicate the specified resource.
    */
    public function duplicate(VisionBoard $visionBoard)
    {
        DB::beginTransaction();

        try {
            $newVisionBoard = $visionBoard->replicate();
            $newVisionBoard->name = $visionBoard->name . ' - copy';
            $newVisionBoard->push(); // Save the duplicated record

            DB::commit();

            return response()->json([
                'message' => 'Vision board berhasil diduplikat.',
                'redirect' => url()->previous(),
            ]);
        } catch (\Throwable $th) {
            info('Duplicate Error:', [$th]);
            DB::rollBack();

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VisionBoard $visionBoard)
    {
        DB::beginTransaction();

        try {
            $visionBoard->delete();

            DB::commit();

            return response()->json([
                'message' => trans('Berhasil dihapus.'),
                'redirect' => url()->previous(),
            ]);
        } catch (\Throwable $th) {
            info('Delete Error:', [$th]);
            DB::rollBack();

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }
}
