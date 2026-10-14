@props(['count' => 0])

@php($views = (int) $count)

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1.5']) }}>
    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>
    {{ number_format($views, 0, ',', ' ') }} {{ \Illuminate\Support\Str::plural('vue', $views) }}
</span>
