<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'category_id', 'user_id', 'title', 'slug', 'excerpt', 'body', 'cover',
    'status', 'featured', 'published_at', 'views', 'meta_title', 'meta_description',
])]
class Post extends Model
{
    use HasSlug;

    public const STATUSES = [
        'brouillon' => 'Brouillon',
        'en_attente' => 'En attente de validation',
        'publie' => 'Publié',
        'archive' => 'Archivé',
    ];

    protected function casts(): array
    {
        return [
            'featured' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'publie')
            ->where(fn ($q) => $q->whereNull('published_at')->orWhere('published_at', '<=', now()));
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
