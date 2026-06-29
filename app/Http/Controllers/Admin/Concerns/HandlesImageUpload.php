<?php

namespace App\Http\Controllers\Admin\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait HandlesImageUpload
{
    protected function mergeImagePath(Request $request, array $data, string $field = 'image_path', string $disk = 'public', string $directory = 'site'): array
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store($directory, $disk);
            $data[$field] = '/storage/'.$path;
        }

        return $data;
    }

    protected function deleteStoredImage(?string $path): void
    {
        if (! $path || ! str_starts_with($path, '/storage/')) {
            return;
        }

        $relative = str_replace('/storage/', '', $path);
        Storage::disk('public')->delete($relative);
    }
}
