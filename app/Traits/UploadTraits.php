<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadTraits
{
    /**
     * Upload the file with slugging to a given path
     *
     * @param UploadedFile $image
     * @param $path
     * @return string
     */
    public function uploadFile(UploadedFile $image, String $diskName = 'public', String $subFolder = null)
    {
        if (!$image) {
            return null;
        }

        $extension = $image->getClientOriginalExtension();
        $name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $image_name = $image->hashName();
        $filePath = $subFolder ? Carbon::now()->format('Y/m/d/') . $subFolder . '/' : Carbon::now()->format('Y/m/d/');
        Storage::disk($diskName)->putFileAs($filePath, $image, $image_name);
        return $filePath . $image_name;
    }

    /**
     * Handling delete file.
     */
    public function deleteFile(?string $path): null
    {
        try {
            if ($path != null) {
                $pathReplace = str_replace('storage/', '', parse_url($path, PHP_URL_PATH));
                if (Storage::disk('public')->exists($pathReplace)) {
                    Storage::disk('public')->delete($pathReplace);
                    // info('File deleted: ' . $pathReplace);
                } else {
                    // info('File not found: ' . $pathReplace);
                }
                return null;
            } else {
                return null;
            }
        } catch (\Throwable $th) {
            info($th);

            return null;
        }
    }
}
