<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use App\Models\Concerns\HasViews;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'title', 'slug', 'excerpt', 'context', 'objectives', 'results', 'cover',
    'gallery', 'indicators', 'location', 'started_at', 'ended_at', 'status', 'featured', 'order', 'views',
])]
class Project extends Model
{
    use HasSlug, HasViews;

    protected function casts(): array
    {
        return [
            'gallery' => 'array',
            'indicators' => 'array',
            'started_at' => 'date',
            'ended_at' => 'date',
            'featured' => 'boolean',
        ];
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
