<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'title', 'slug', 'excerpt', 'context', 'objectives', 'results', 'cover',
    'gallery', 'indicators', 'location', 'started_at', 'ended_at', 'status', 'featured', 'order',
])]
class Project extends Model
{
    use HasSlug;

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
