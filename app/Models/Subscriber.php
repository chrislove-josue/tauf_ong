<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

#[Fillable(['email', 'name', 'token', 'is_active', 'subscribed_at'])]
class Subscriber extends Model
{
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'subscribed_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Subscriber $subscriber): void {
            $subscriber->token ??= Str::random(40);
            $subscriber->subscribed_at ??= now();
        });
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
