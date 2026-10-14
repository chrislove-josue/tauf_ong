<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use App\Models\Concerns\HasViews;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'title', 'slug', 'subtitle', 'excerpt', 'body', 'cover', 'icon', 'color',
    'featured', 'status', 'order', 'meta_title', 'meta_description', 'views',
])]
class Program extends Model
{
    use HasSlug, HasViews;

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
