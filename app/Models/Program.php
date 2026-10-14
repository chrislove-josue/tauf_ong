<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'title', 'slug', 'subtitle', 'excerpt', 'body', 'cover', 'icon', 'color',
    'featured', 'status', 'order', 'meta_title', 'meta_description',
])]
class Program extends Model
{
    use HasSlug;

    protected function casts(): array
    {
        return ['featured' => 'boolean'];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'publie');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
