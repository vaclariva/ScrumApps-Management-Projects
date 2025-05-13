<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\View\View;
use Illuminate\Support\Arr;
use App\Traits\UploadTraits;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Define traits.
     */
    use UploadTraits;

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();

            if($validated['is_weak_password'] && ! isset($request->checklist_weak_password)){
                return response()->json([
                    'message' => "Centang 'Gunakan kata sandi meskipun lemah' untuk menggunakan kata sandi lemah.",
                ], 400);
            }

            $request->user()->fill(Arr::except($validated, ['photo_path', 'password']));

                // Handling if avatar was changed
                if ($request->hasFile('photo_path')) {
                    $this->deleteFile($request->user()->getRawOriginal('photo_path'));
                    $request->user()->photo_path = $this->uploadFile($request->file('photo_path'));

                } elseif ($request->photo_path_remove) {
                    $request->user()->photo_path = $this->deleteFile($request->user()->getRawOriginal('photo_path'));

                }

            // Handling if password was changed
            if ($request->filled('password')) {
                $request->user()->password = $request->password;
                $request->user()->is_weak_password = $request->is_weak_password;
            }

            $request->user()->save();

            return response()->json([
                'message' => trans('admin.update-success'),
                'redirect' => route('profile.edit'),
            ]);
        } catch (\Throwable $th) {
            info($th);

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }
}
