<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckDev\StoreCheckDevRequest;
use App\Models\CheckDev;
use App\Models\Development;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckDevController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($devId)
    {
        $developments = Development::findOrFail($devId);
        $checkDevs = CheckDev::where('dev_id', $devId)->get();
        return view('developments.index', compact('developments', 'checkDevs'));
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
    public function store(StoreCheckDevRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $data['status'] = $data['status'] ?? 'inactive';

            $checkDev = CheckDev::create($data);

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
                'redirect' => url()->previous(),
                'check_dev' => $checkDev,
            ]);

        } catch (\Throwable $th) {
            Log::error('Gagal menyimpan checklist development:', ['error' => $th]);
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
    public function update(StoreCheckDevRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $data['status'] = $data['status'] ?? 'inactive';

            $checkDev = CheckDev::findOrFail($id);
            $checkDev->update($data);

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
                'check_dev' => $checkDev,
            ]);

        } catch (\Throwable $th) {
            Log::error('Gagal mengupdate checklist development:', ['error' => $th]);
            DB::rollBack();

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( CheckDev $checkDev)
    {
        try {
            DB::beginTransaction();
            $checkDev->delete();

            DB::commit();

            return response()->json([
                'message' => 'Checklist berhasil dihapus.',
                'CheckDev' => $checkDev,
            ]);
        } catch (\Throwable $th) {
            Log::error('Gagal menghapus checklist:', ['error' => $th]);
            DB::rollBack();

            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus checklist.',
            ], 500);
        }
    }
}
