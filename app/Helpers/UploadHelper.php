<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;

class UploadHelper
{
    public static function fileUpload(string $path, UploadedFile $file): ?string
    {
        $filenameWithExt = $file->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $fileName = $filename . '_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($path), $fileName);

        return asset($path . '/' . $fileName);
    }

    public static function multipleFileUpload(string $path, array $files): array
    {
        $fileUrls = [];

        foreach ($files as $file) {
            $fileUrls[] = self::fileUpload($path, $file);
        }

        return $fileUrls;
    }
}
