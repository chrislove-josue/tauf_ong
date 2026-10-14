<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

#[Fillable(['key', 'value', 'group', 'type'])]
class Setting extends Model
{
    public static function get(string $key, mixed $default = null): mixed
    {
        $settings = static::all_cached();

        return $settings[$key] ?? $default;
    }

    public static function set(string $key, mixed $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget('tauf_settings');
    }

    /**
     * @return array<string, mixed>
     */
    public static function all_cached(): array
    {
        return Cache::rememberForever('tauf_settings', function () {
            return static::query()->pluck('value', 'key')->toArray();
        });
    }

    public static function flush(): void
    {
        Cache::forget('tauf_settings');
    }
}
