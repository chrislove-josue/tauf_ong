<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'slug', 'subtitle', 'body', 'cover', 'template', 'status', 'meta_title', 'meta_description', 'order'])]
class Page extends Model
{
    use HasSlug;

    public const STATUSES = ['brouillon', 'publie'];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'publie');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
