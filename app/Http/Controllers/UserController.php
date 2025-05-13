<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Traits\UploadTraits;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    /**
     * Define traits.
     */
    use UploadTraits;


    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        try {
            return view('users.index');
        } catch (\Throwable $th) {
            info($th);

            abort(500);
        }
    }

    /**
     * Define datatable instance of users.
     */
    public function list(Request $request)
    {
        try {
            $search = $request->input('search')['value'];
            $filterRole = $request->role;

            return DataTables::of(
                User::where('role', '!=', 'Superadmin')
                    ->when($filterRole, function (Builder $query) use ($filterRole) {
                        $query->where('role', $filterRole);
                    })
                    ->when($search != '', function (Builder $query) use ($search) {
                        $query->where(function (Builder $query) use ($search) {
                            $query->where('name', 'LIKE', '%' . $search . '%')
                                ->orWhere('email', 'LIKE', '%' . $search . '%')
                                ->orWhere('phone_number', 'LIKE', '%' . $search . '%');
                        });
                    })
            )
                ->addIndexColumn()
                ->editColumn('name', fn(User $user) => view('users.partials.datatable-name', ['name' => $user->name, 'photo_path' => $user->photo_path, 'url_edit' => route('users.edit', $user->id)]))
                ->addColumn('actions', fn(User $user) => view('users.partials.datatable-actions', ['url_delete' => route('users.destroy', $user->id)]))
                ->editColumn('phone_number', fn(User $user): mixed => $user->phone_number ?? '-')
                ->editColumn('email', fn(User $user) => $user->email ?? '-')
                ->editColumn('role', fn(User $user) => $user->role_label ?? '-')
                ->order(function (Builder $query) use ($request) {
                    $order = $request->input('order')[0];

                    if ($order['column'] == 0) {
                        $query->orderBy('created_at', 'desc');
                    } elseif ($order['column'] == 1) {
                        $query->orderBy('name', $order['dir']);
                    } elseif ($order['column'] == 3) {
                        $query->orderBy('email', $order['dir']);
                    }
                })
                ->make(true);
        } catch (\Throwable $th) {
            info($th);

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! auth()->user()->is_superadmin) {
            abort(403);
        }
        try {
            return view('users.create',[
                'roles' => listRoles()
            ]);
        } catch (\Throwable $th) {
            info($th);

            abort(500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = User::create(array_merge(
                Arr::except($request->validated(), ['photo_path']),
                [
                    'enabled_2fa' => '0',
                ]
            ));

            if ($request->hasFile('photo_path')) {
                $user->update([
                    'photo_path' => $this->uploadFile(image: $request->file('photo_path'), subFolder: 'users'),
                ]);
            }

            $user->sendCreatePasswordNotification();

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
                'redirect' => route('users.index'),
            ]);
        } catch (\Throwable $th) {
            info($th);
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
    public function edit(User $user)
    {
        if (! auth()->user()->is_superadmin) {
            abort(403);
        }
        try {
            return view('users.edit', [
                'user' => $user,
                'roles' => listRoles()
            ]);
        } catch (\Throwable $th) {
            info($th);

            abort(500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        try {
            DB::beginTransaction();

            $user->update(Arr::except($request->validated(), ['photo_path']));

            /**
             * Handling avatar upload.
             */
            if ($request->hasFile('photo_path')) {

                $this->deleteFile($user->photo_path);

                $user->update([
                    'photo_path' => $this->uploadFile($request->file('photo_path'), subFolder: 'users'),
                ]);
            } elseif ($request->photo_path_remove) {
                $user->update([
                    'photo_path' => $this->deleteFile($user->photo_path)
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
                'redirect' => route('users.index'),
            ]);
        } catch (\Throwable $th) {
            info($th);
            DB::rollBack();

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (! auth()->user()->is_superadmin) {
            abort(403);
        }
        try {
            DB::beginTransaction();

            // Handling photo_path remove from storage.
            if ($user->getRawOriginal('photo_path')) {
                $this->deleteFile($user->getRawOriginal('photo_path'));
            }

            $user->delete();

            DB::commit();

            return response()->json([
                'message' => trans('Berhasil dihapus.'),
                'redirect' => route('users.index'),
            ]);
        } catch (\Throwable $th) {
            info($th);
            DB::rollBack();

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }

    /**
     * Resend email create password
     */
    public function resendEmailRegister(User $user)
    {
        try {
            if (! $user->is_password_null) {
                return response()->json([
                    'message' => 'Gagal, kata sandi sudah di input sebelumnya',
                ], 403);
            }

            $user->sendCreatePasswordNotification();

            return response()->json([
                'message' => 'Tautan untuk reset kata sandi berhasil terkirim. Minta kepada pengguna baru untuk cek kotak masuk secara berkala.',
                'redirect' => route('users.edit', $user->id)
            ]);
        } catch (\Throwable $th) {
            Log::info($th->getMessage());

            abort(500);
        }
    }
}
