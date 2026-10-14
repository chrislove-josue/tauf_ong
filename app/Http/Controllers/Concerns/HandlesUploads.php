<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HandlesUploads
{
    protected function storeFile(?UploadedFile $file, string $folder = 'uploads'): ?string
    {
        if (! $file) {
            return null;
        }

        $name = Str::random(20).'-'.Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $extension = $file->getClientOriginalExtension();
        $filename = $extension ? "{$name}.{$extension}" : $name;

        return $file->storeAs($folder, $filename, 'public');
    }

    protected function deleteFile(?string $path): void
    {
        if (blank($path) || Str::startsWith($path, ['images/', 'build/'])) {
            return;
        }

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
