<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckDev\StoreCheckDevRequest;
use App\Models\CheckDev;
use App\Models\Development;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\TrelloService;
use Illuminate\Support\Facades\Http;

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
            $development = Development::find($checkDev->dev_id ?? $data['dev_id']);
            if ($development && $development->trello_card_id) {
                $trelloService = new TrelloService();
                $checklistGroups = CheckDev::where('dev_id', $development->id)
                    ->get()
                    ->groupBy('category')
                    ->map(function($items, $category) {
                        return [
                            'category' => $category ?: 'Checklist',
                            'items' => $items->map(function($item) {
                                return [
                                    'name' => $item->name,
                                    'checked' => $item->status === 'active',
                                ];
                            })->toArray()
                        ];
                    })->values()->toArray();
                $trelloService->syncChecklist($development->trello_card_id, $checklistGroups);
            }

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
            $development = Development::find($checkDev->dev_id ?? $data['dev_id']);
            if ($development && $development->trello_card_id) {
                $trelloService = new TrelloService();
                $checklistGroups = CheckDev::where('dev_id', $development->id)
                    ->get()
                    ->groupBy('category')
                    ->map(function($items, $category) {
                        return [
                            'category' => $category ?: 'Checklist',
                            'items' => $items->map(function($item) {
                                return [
                                    'name' => $item->name,
                                    'checked' => $item->status === 'active',
                                ];
                            })->toArray()
                        ];
                    })->values()->toArray();
                $trelloService->syncChecklist($development->trello_card_id, $checklistGroups);
            }

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
            $development = Development::find($checkDev->dev_id ?? $checkDev->dev_id);
            if ($development && $development->trello_card_id) {
                $trelloService = new TrelloService();
                $checklistGroups = CheckDev::where('dev_id', $development->id)
                    ->get()
                    ->groupBy('category')
                    ->map(function($items, $category) {
                        return [
                            'category' => $category ?: 'Checklist',
                            'items' => $items->map(function($item) {
                                return [
                                    'name' => $item->name,
                                    'checked' => $item->status === 'active',
                                ];
                            })->toArray()
                        ];
                    })->values()->toArray();
                $trelloService->syncChecklist($development->trello_card_id, $checklistGroups);
            }

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
