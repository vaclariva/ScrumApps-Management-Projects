<?php

namespace App\Http\Controllers;

use App\Http\Requests\Development\StoreDevelopmentRequest;
use App\Http\Requests\Development\UpdateDevelopmentRequest;
use App\Models\Development;
use App\Models\Project;
use App\Models\User;
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
        $users = User::where('role', 'ProductOwner')->get();

        $projectId = $request->query('project_id');
        if (!$projectId) {
            abort(404, 'Project ID tidak ditemukan');
        }

        $project = Project::findOrFail($projectId);
        $developments = Development::where('project_id', $projectId)->latest()->get();

        // Inisialisasi array untuk kanban board
        $tasks = [
            '_todo'      => [],
            '_inprocess' => [],
            '_working'   => [],
            '_done'      => [],
        ];

        $allTasks = []; // Menyimpan semua detail task

        foreach ($developments as $dev) {
            $statusKey = match ($dev->status) {
                'todo'        => '_todo',
                'in_progress' => '_inprocess',
                'qa'          => '_working',
                'done'        => '_done',
                default       => '_todo',
            };

            // Untuk tampilan Kanban
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

            // Untuk JSON detail task
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

        Log::info('Isi dari variabel $tasks:', $tasks);
        Log::info('Isi dari variabel $allTasks:', $allTasks);

        // Jika request berupa Ajax atau menginginkan JSON
        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Data developments berhasil diambil',
                'project' => $project,
                'tasks'   => $allTasks,
            ]);
        }

        // Jika biasa, return view
        return view('developments.index', compact('users', 'project', 'tasks', 'allTasks'));
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDevelopmentRequest $request, Development $development)
    {
        // Gunakan parameter route model binding untuk langsung mendapatkan instance Development
        // Pastikan route Anda didefinisikan seperti Route::put('/developments/{development}', 'DevelopmentController@update');
        // atau Route::resource juga otomatis akan menangani ini.

        DB::beginTransaction();

        try {
            $data = $request->validated();

            // Tangani pembaruan file
            if ($request->hasFile('file')) {
                // Hapus file lama jika ada
                if ($development->file && Storage::disk('public')->exists($development->file)) {
                    Storage::disk('public')->delete($development->file);
                }

                $uploadedFile = $request->file('file');
                $originalFileName = $uploadedFile->getClientOriginalName();
                $cleanedFileName = Str::slug(pathinfo($originalFileName, PATHINFO_FILENAME)) . '.' . $uploadedFile->getClientOriginalExtension();
                $directory = 'developments_files';
                $filePath = $directory . '/' . $cleanedFileName;

                // Cek jika file dengan nama yang sama sudah ada di path baru (setelah cleanup)
                if (Storage::disk('public')->exists($filePath)) {
                    $fileNameWithoutExt = pathinfo($originalFileName, PATHINFO_FILENAME);
                    $extension = $uploadedFile->getClientOriginalExtension();
                    $uniqueFileName = $fileNameWithoutExt . '-' . time() . '.' . $extension;
                    $filePath = $directory . '/' . $uniqueFileName;
                }

                Storage::disk('public')->put($filePath, file_get_contents($uploadedFile->getRealPath()));
                $data['file'] = $filePath;
            } elseif ($request->has('file') && $request->file == null) {
                // Ini menangani kasus jika pengguna ingin menghapus file yang ada
                // Dengan mengirimkan input 'file' kosong atau null dari form
                if ($development->file && Storage::disk('public')->exists($development->file)) {
                    Storage::disk('public')->delete($development->file);
                }
                $data['file'] = null; // Set di database menjadi null
            } else {
                // Jika tidak ada file baru diunggah dan tidak ada indikasi untuk menghapus file,
                // pertahankan file yang sudah ada
                unset($data['file']); // Hapus 'file' dari $data agar tidak menimpa dengan null
            }

            // Perbarui data development
            $development->update($data);

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'), // 200 OK for update
                'redirect' => url()->previous(),
                // Kembalikan data task yang diperbarui untuk refresh di frontend jika diperlukan
                'task' => [
                    'id' => $development->id,
                    'title' => $development->name,
                    'desc' => $development->desc,
                    'link' => $development->link,
                    'file' => $development->file ? Storage::url($development->file) : null,
                    'status' => '_'.$development->status,
                    // Kelas mungkin perlu diperbarui sesuai status baru
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
            info('Update Error:', [$th]);
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
        // Konversi status dari JS (yang pakai underscore) ke format valid
        $statusMap = [
            '_todo'       => 'todo',
            '_inprocess'  => 'in_progress',
            '_qa'         => 'qa',
            '_done'       => 'done',
        ];
        Log::info('Status yang dikirim:', ['status' => $request->input('status')]);

        $rawStatus = $request->input('status');
        $convertedStatus = $statusMap[$rawStatus] ?? null;

        // Validasi status setelah dikonversi
        if (!in_array($convertedStatus, ['todo', 'in_progress', 'qa', 'done'])) {
            return response()->json(['message' => 'Status tidak valid.'], 422);
        }

        // Cari data development berdasarkan ID
        $development = Development::findOrFail($id);
        $development->status = $convertedStatus;
        $development->save();

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
}
