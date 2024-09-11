<?php

namespace App\Services;

use App\Models\File;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileService
{

    public static function uploadFile( UploadedFile $file, Model $model, string $lang = 'ru', string $diskName = 'document',string  $filePath = "/", string $uploaded_at = null): void
    {
        if (isset($file)) {
            $file_name = $filePath.time() . "_" . Str::random(10) . "." . $file->getClientOriginalExtension();
            Storage::disk($diskName)->put($file_name, file_get_contents($file));
            $model->files()->create([
                'path' => $file_name,
                'lang' => $lang,
                'size' => $file->getSize(),
                'type' => $file->getClientOriginalExtension(),
                'uploaded_at' => $uploaded_at ?? Carbon::now()
            ]);
        }
    }

    public static function fileDelete(string $diskName ,int $id): int
    {
        $file = File::query()->findOrFail($id);
        Storage::disk($diskName)->delete($file->path);
        $file->delete();
        return $file->fileable_id;
    }
}
