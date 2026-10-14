<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'slug', 'description', 'cover', 'order'])]
class Album extends Model
{
    use HasSlug;

    protected $slugSource = 'name';

    public function media(): HasMany
    {
        return $this->hasMany(Media::class)->orderBy('order');
    }

    public function images(): HasMany
    {
        return $this->hasMany(Media::class)->where('type', 'image')->orderBy('order');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
