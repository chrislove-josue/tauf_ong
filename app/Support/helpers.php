<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if (! function_exists('tauf_setting')) {
    function tauf_setting(string $key, mixed $default = null): mixed
    {
        return Setting::get($key, $default);
    }
}

if (! function_exists('upload_url')) {
    function upload_url(?string $path, ?string $fallback = null): string
    {
        if (blank($path)) {
            return $fallback ? asset($fallback) : asset('images/placeholder.svg');
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (Str::startsWith($path, ['images/', 'build/'])) {
            return asset($path);
        }

        return Storage::disk('public')->url($path);
    }
}

if (! function_exists('french_date')) {
    function french_date($date, string $format = 'd F Y'): string
    {
        if (blank($date)) {
            return '';
        }

        $date = $date instanceof \DateTimeInterface
            ? \Illuminate\Support\Carbon::instance($date)
            : \Illuminate\Support\Carbon::parse($date);

        return $date->locale('fr')->translatedFormat($format);
    }
}
