<?php

namespace App\Http\Controllers;

use App\Http\Requests\Development\StoreDevelopmentRequest;
use App\Http\Requests\Development\UpdateDevelopmentRequest;
use App\Models\CheckDev;
use App\Models\Development;
use App\Models\Project;
use App\Models\User;
use App\Services\TrelloService;
use DragonCode\Support\Facades\Helpers\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DevelopmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $projects = Project::with('user')->get();
        $users = User::where('role', 'BusinessAnalyst')->get();

        $projectId = $request->query('project_id');
        if (!$projectId) {
            abort(404, 'Project ID tidak ditemukan');
        }

        $project = Project::findOrFail($projectId);
        $developments = Development::where('project_id', $projectId)->latest()->get();
        $checkDevs = CheckDev::whereIn('dev_id', $developments->pluck('id'))->get();

        $tasks = [
            '_todo'      => [],
            '_inprocess' => [],
            '_working'   => [],
            '_done'      => [],
        ];

        $allTasks = [];

        foreach ($developments as $dev) {
            $statusKey = match ($dev->status) {
                'todo'        => '_todo',
                'in_progress' => '_inprocess',
                'qa'          => '_working',
                'done'        => '_done',
                default       => '_todo',
            };

            $tasks[$statusKey][] = [
                'id'    => $dev->id,
                'title' => '<span class="fw-bold">' . e($dev->name) . '</span>',
                'class' => 'light-' . match ($dev->status) {
                    'todo'        => 'primary',
                    'in_progress' => 'warning',
                    'qa'          => 'info',
                    'done'        => 'success',
                    default       => 'primary',
                },
            ];

            $allTasks[] = [
                'id'     => $dev->id,
                'title'  => $dev->name,
                'desc'   => $dev->desc,
                'link'   => $dev->link,
                'file'   => $dev->file,
                'status' => '_' . $dev->status,
                'class'  => 'bg-light-' . match ($dev->status) {
                    'todo'        => 'primary',
                    'in_progress' => 'warning',
                    'qa'          => 'info',
                    'done'        => 'success',
                    default       => 'primary',
                },
            ];
        }

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Data developments berhasil diambil',
                'project' => $project,
                'tasks'   => $allTasks,
            ]);
        }

        return view('developments.index', compact('users', 'project', 'tasks', 'allTasks', 'developments', 'checkDevs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDevelopmentRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $data['status'] = $data['status'] ?? 'todo';
            if ($request->hasFile('file')) {
                $uploadedFile = $request->file('file');
                $originalFileName = $uploadedFile->getClientOriginalName();
                $cleanedFileName = Str::slug(pathinfo($originalFileName, PATHINFO_FILENAME)) . '.' . $uploadedFile->getClientOriginalExtension();
                $directory = 'developments_files';
                $filePath = $directory . '/' . $cleanedFileName;
                if (Storage::disk('public')->exists($filePath)) {
                    $fileNameWithoutExt = pathinfo($originalFileName, PATHINFO_FILENAME);
                    $extension = $uploadedFile->getClientOriginalExtension();
                    $uniqueFileName = $fileNameWithoutExt . '-' . time() . '.' . $extension;
                    $filePath = $directory . '/' . $uniqueFileName;
                }
                Storage::disk('public')->put($filePath, file_get_contents($uploadedFile->getRealPath()));
                $data['file'] = $filePath;

            } else {
                $data['file'] = null;
            }

            $development = Development::create($data);

            $project = Project::find($data['project_id']);
            if ($project && $project->trello_board_id) {
                $trelloService = new TrelloService();
                $lists = $trelloService->getBoardLists($project->trello_board_id);
                $statusToListMap = [
                    'todo' => 'To Do',
                    'in_progress' => 'In Progress',
                    'qa' => 'Quality Assurance',
                    'done' => 'Done'
                ];
                $listName = $statusToListMap[$development->status] ?? 'To Do';
                $listId = collect($lists)->firstWhere('name', $listName)['id'] ?? $lists[0]['id'];

                $card = $trelloService->createCard($listId, $development->name, $development->desc);
                if ($card && isset($card['id'])) {
                    $development->trello_card_id = $card['id'];
                    $development->save();

                    if (!empty($development->link)) {
                        $trelloService->addAttachmentToCard($card['id'], $development->link, 'Link');
                    }
                    if (!empty($development->file)) {
                        $fileUrl = Storage::url($development->file);
                        $trelloService->addAttachmentToCard($card['id'], asset($fileUrl), 'File');
                    }
                }
            }

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
                'redirect' => url()->previous(),
                'task' => [
                    'id' => $development->id,
                    'title' => $development->name,
                    'desc' => $development->desc,
                    'link' => $development->link,
                    'file' => $development->file,
                    'status' => '_'.$development->status,
                    'class' => 'bg-light-primary'
                ]
            ]);
        } catch (\Throwable $th) {
            info('Store Error:', [
                'error_message' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
                'line' => $th->getLine(),
                'file' => $th->getFile(),
                'previous' => $th->getPrevious(),
                'request_data' => $request->all(),
            ]);
            DB::rollBack();

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Development $development)
    {
        $developments = Development::all();

        $kanbanData = [
            '_todo' => [],
            '_inprocess' => [],
            '_working' => [],
            '_done' => [],
        ];

        foreach ($developments as $item) {
            $statusKey = match($item->status) {
                'todo' => '_todo',
                'in_progress' => '_inprocess',
                'qa' => '_working',
                'done' => '_done',
                default => '_todo',
            };

            $kanbanData[$statusKey][] = [
                'id' => $item->id,
                'title' => '<span class="fw-bold">' . e($item->name) . '</span>',
                'class' => 'light-' . match($item->status) {
                    'todo' => 'primary',
                    'in_progress' => 'warning',
                    'qa' => 'info',
                    'done' => 'success',
                    default => 'primary',
                },
            ];
        }

        return view('developments.index', compact('kanbanData'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDevelopmentRequest $request, Development $development)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            if ($request->hasFile('file')) {
                if ($development->file && Storage::disk('public')->exists($development->file)) {
                    Storage::disk('public')->delete($development->file);
                }

                $uploadedFile = $request->file('file');
                $originalFileName = $uploadedFile->getClientOriginalName();
                $cleanedFileName = Str::slug(pathinfo($originalFileName, PATHINFO_FILENAME)) . '.' . $uploadedFile->getClientOriginalExtension();
                $directory = 'developments_files';
                $filePath = $directory . '/' . $cleanedFileName;

                if (Storage::disk('public')->exists($filePath)) {
                    $fileNameWithoutExt = pathinfo($originalFileName, PATHINFO_FILENAME);
                    $extension = $uploadedFile->getClientOriginalExtension();
                    $uniqueFileName = $fileNameWithoutExt . '-' . time() . '.' . $extension;
                    $filePath = $directory . '/' . $uniqueFileName;
                }

                Storage::disk('public')->put($filePath, file_get_contents($uploadedFile->getRealPath()));
                $data['file'] = $filePath;
            } elseif ($request->has('file') && $request->file == null) {
                if ($development->file && Storage::disk('public')->exists($development->file)) {
                    Storage::disk('public')->delete($development->file);
                }
                $data['file'] = null;
            } else {
               unset($data['file']);
            }

            $development->update($data);
            $project = $development->project;
            if ($project && $project->trello_board_id && $development->trello_card_id) {
                $trelloService = new TrelloService();
                $lists = $trelloService->getBoardLists($project->trello_board_id);
                $statusToListMap = [
                    'todo' => 'To Do',
                    'in_progress' => 'In Progress',
                    'qa' => 'Quality Assurance',
                    'done' => 'Done'
                ];
                $listName = $statusToListMap[$development->status] ?? 'To Do';
                $listId = collect($lists)->firstWhere('name', $listName)['id'] ?? $lists[0]['id'];

                $trelloService->updateCard($development->trello_card_id, [
                    'name' => $development->name,
                    'desc' => $development->desc,
                    'idList' => $listId
                ]);

                if (!empty($development->link)) {
                    $trelloService->addAttachmentToCard($development->trello_card_id, $development->link, 'Link');
                }
                if (!empty($development->file)) {
                    $fileUrl = Storage::url($development->file);
                    $trelloService->addAttachmentToCard($development->trello_card_id, asset($fileUrl), 'File');
                }
            }

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
                'redirect' => url()->previous(),
                'task' => [
                    'id' => $development->id,
                    'title' => $development->name,
                    'desc' => $development->desc,
                    'link' => $development->link,
                    'file' => $development->file ? Storage::url($development->file) : null,
                    'status' => '_'.$development->status,
                    'class' => 'bg-light-' . match($development->status) {
                        'todo'        => 'primary',
                        'in_progress' => 'warning',
                        'qa'          => 'info',
                        'done'        => 'success',
                        default       => 'primary',
                    },
                ]
            ]);
        } catch (\Throwable $th) {
            info('Update Error:', [
                'error_message' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
                'line' => $th->getLine(),
                'file' => $th->getFile(),
                'previous' => $th->getPrevious(),
                'request_data' => $request->all(),
            ]);
            DB::rollBack();

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }

    /**
     * Update status the specified resource from storage.
     */
    public function updateStatus(Request $request, $id)
    {
        $statusMap = [
            '_todo'       => 'todo',
            '_in_progress'  => 'in_progress',
            '_qa'         => 'qa',
            '_done'       => 'done',
        ];
        Log::info('Status yang dikirim:', ['status' => $request->input('status')]);

        $rawStatus = $request->input('status');
        $convertedStatus = $statusMap[$rawStatus] ?? null;

        if (!in_array($convertedStatus, ['todo', 'in_progress', 'qa', 'done'])) {
            return response()->json(['message' => 'Status tidak valid.'], 422);
        }

        $development = Development::findOrFail($id);
        $development->status = $convertedStatus;
        $development->save();

        $project = $development->project;
        if ($project && $project->trello_board_id && $development->trello_card_id) {
            $trelloService = new TrelloService();
            $lists = $trelloService->getBoardLists($project->trello_board_id);
            $statusToListMap = [
                'todo' => 'To Do',
                'in_progress' => 'In Progress',
                'qa' => 'Quality Assurance',
                'done' => 'Done'
            ];
            $listName = $statusToListMap[$development->status] ?? 'To Do';
            $listId = collect($lists)->firstWhere('name', $listName)['id'] ?? $lists[0]['id'];

            $trelloService->updateCard($development->trello_card_id, [
                'idList' => $listId
            ]);
        }

        return response()->json(['message' => 'Status berhasil diperbarui.']);
    }

    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Development $development)
    {
        DB::beginTransaction();

        try {
            if ($development->file && Storage::disk('public')->exists($development->file)) {
                Storage::disk('public')->delete($development->file);
            }
            if ($development->trello_card_id) {
                $trelloService = new TrelloService();
                $trelloService->deleteCard($development->trello_card_id);
            }

            $development->delete();

            DB::commit();

            return response()->json([
                'message' => 'Data berhasil dihapus.',
                'status' => true
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Gagal menghapus development:', [$th]);

            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus data.',
                'status' => false
            ], 500);
        }
    }

    /**
     * Integrasi dengan Trello
     */
    public function integrateWithTrello(Request $request)
    {
        DB::beginTransaction();

        try {
            $projectId = $request->input('project_id');
            $project = Project::findOrFail($projectId);

            if ($project->trello_board_id) {
                return response()->json([
                    'message' => 'Proyek sudah terintegrasi dengan Trello',
                    'board_url' => (new TrelloService())->getBoardUrl($project->trello_board_id),
                    'already_integrated' => true
                ]);
            }

            $trelloService = new TrelloService();

            $boardData = $trelloService->createBoard(
                $project->name,
                $project->label
            );

            if (!$boardData) {
                throw new \Exception('Gagal membuat board di Trello');
            }

            $project->trello_board_id = $boardData['id'];
            $project->save();

            // === Daftarkan webhook Trello secara otomatis ===
            $callbackURL = 'https://d6e2-103-166-11-169.ngrok-free.app/api/trello/webhook'; // Ganti dengan URL ngrok kamu
            $trelloService->registerWebhook($callbackURL, $boardData['id']);
            // =================================================

            $developments = Development::where('project_id', $projectId)->get();
            $lists = $trelloService->getBoardLists($boardData['id']);

            $statusToListMap = [
                'todo' => 'To Do',
                'in_progress' => 'In Progress',
                'qa' => 'Quality Assurance',
                'done' => 'Done'
            ];

            foreach ($developments as $development) {
                $listName = $statusToListMap[$development->status] ?? 'To Do';
                $listId = collect($lists)->firstWhere('name', $listName)['id'] ?? $lists[0]['id'];

                $checklist = CheckDev::where('dev_id', $development->id)
                    ->get()
                    ->map(function($item) {
                        return ['name' => $item->name];
                    })
                    ->toArray();

                $trelloService->createCard(
                    $listId,
                    $development->name,
                    $development->desc,
                    $checklist
                );
            }

            $teams = $project->teams;
            foreach ($teams as $team) {
                if ($team->user && $team->user->email) {
                    $trelloService->addMemberToBoard($boardData['id'], $team->user->email);
                }
            }

            DB::commit();

            return response()->json([
                'message' => 'Berhasil terintegrasi dengan Trello!',
                'board_url' => $trelloService->getBoardUrl($boardData['id']),
                'already_integrated' => false
            ]);

        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error saat integrasi Trello:', [
                'error_message' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
                'line' => $th->getLine(),
                'file' => $th->getFile(),
                'previous' => $th->getPrevious(),
                'request_data' => $request->all(),
            ]);

            return response()->json([
                'message' => 'Terjadi kesalahan saat integrasi dengan Trello: ' . $th->getMessage(),
            ], 500);
        }
    }
}
