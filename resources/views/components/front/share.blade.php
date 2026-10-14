@props(['title' => null, 'url' => null])

@php
    $shareUrl = $url ?? url()->current();
    $shareTitle = $title ?? config('app.name');
@endphp

<div {{ $attributes->merge(['class' => 'flex items-center gap-3']) }}>
    <span class="text-sm font-semibold text-tauf-ink">Partager :</span>
    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}" target="_blank" rel="noopener" aria-label="Partager sur Facebook" class="flex h-9 w-9 items-center justify-center rounded-full bg-tauf-green-light text-tauf-green transition hover:bg-tauf-green hover:text-white">
        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><use href="#icon-facebook"/></svg>
    </a>
    <a href="https://twitter.com/intent/tweet?url={{ urlencode($shareUrl) }}&text={{ urlencode($shareTitle) }}" target="_blank" rel="noopener" aria-label="Partager sur X (Twitter)" class="flex h-9 w-9 items-center justify-center rounded-full bg-tauf-green-light text-tauf-green transition hover:bg-tauf-green hover:text-white">
        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><use href="#icon-twitter"/></svg>
    </a>
    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($shareUrl) }}" target="_blank" rel="noopener" aria-label="Partager sur LinkedIn" class="flex h-9 w-9 items-center justify-center rounded-full bg-tauf-green-light text-tauf-green transition hover:bg-tauf-green hover:text-white">
        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><use href="#icon-linkedin"/></svg>
    </a>
    <a href="https://wa.me/?text={{ urlencode($shareTitle.' '.$shareUrl) }}" target="_blank" rel="noopener" aria-label="Partager sur WhatsApp" class="flex h-9 w-9 items-center justify-center rounded-full bg-tauf-green-light text-tauf-green transition hover:bg-tauf-green hover:text-white">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 11.5a8.5 8.5 0 01-12.4 7.5L3 21l2-5.1A8.5 8.5 0 1121 11.5z"/></svg>
    </a>
</div>
