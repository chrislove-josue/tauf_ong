<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait HasSlug
{
    public static function bootHasSlug(): void
    {
        static::saving(function ($model): void {
            $source = $model->slugSource ?? 'title';

            if (blank($model->slug)) {
                $model->slug = static::generateUniqueSlug($model->{$source});
            } else {
                $model->slug = static::generateUniqueSlug($model->slug, $model->getKey());
            }
        });
    }

    protected static function generateUniqueSlug(?string $value, $ignoreId = null): string
    {
        $base = Str::slug($value ?: 'element');
        $slug = $base;
        $i = 2;

        while (static::slugExists($slug, $ignoreId)) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }

    protected static function slugExists(string $slug, $ignoreId = null): bool
    {
        $query = static::query()->where('slug', $slug);

        if ($ignoreId) {
            $query->whereKeyNot($ignoreId);
        }

        return $query->exists();
    }
}
