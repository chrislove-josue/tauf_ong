<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['album_id', 'title', 'alt', 'file_path', 'type', 'mime', 'size', 'url', 'order'])]
class Media extends Model
{
    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

    public function isImage(): bool
    {
        return $this->type === 'image';
    }
}
