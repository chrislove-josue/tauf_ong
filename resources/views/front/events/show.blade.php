@extends('layouts.front')

@section('title', $event->title)

@section('meta_description', $event->excerpt ?: $event->title)

@section('og_image', upload_url($event->cover))

@section('content')
    <x-front.banner
        :title="$event->title"
        :subtitle="$event->excerpt"
        :image="$event->cover"
        :crumbs="['Événements' => route('events.index'), Str::limit($event->title, 40) => null]" />

    <section class="container-tauf py-16">
        <div class="grid gap-12 lg:grid-cols-3">
            <article class="lg:col-span-2">
                <div class="mb-6 flex flex-wrap gap-4">
                    <div class="flex items-center gap-3 rounded-2xl bg-tauf-green-light px-5 py-3">
                        <svg class="h-6 w-6 text-tauf-green" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                        <div>
                            <p class="text-xs text-tauf-gray">Date</p>
                            <p class="text-sm font-bold text-tauf-green-dark">{{ french_date($event->starts_at, 'd F Y') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 rounded-2xl bg-tauf-green-light px-5 py-3">
                        <svg class="h-6 w-6 text-tauf-green" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                        <div>
                            <p class="text-xs text-tauf-gray">Heure</p>
                            <p class="text-sm font-bold text-tauf-green-dark">{{ $event->starts_at->format('H:i') }}{{ $event->ends_at ? ' - '.$event->ends_at->format('H:i') : '' }}</p>
                        </div>
                    </div>
                    @if ($event->location)
                        <div class="flex items-center gap-3 rounded-2xl bg-tauf-green-light px-5 py-3">
                            <svg class="h-6 w-6 text-tauf-green" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 21s-7-5.5-7-11a7 7 0 1114 0c0 5.5-7 11-7 11z"/><circle cx="12" cy="10" r="2.5"/></svg>
                            <div>
                                <p class="text-xs text-tauf-gray">Lieu</p>
                                <p class="text-sm font-bold text-tauf-green-dark">{{ $event->location }}</p>
                            </div>
                        </div>
                    @endif
                    <div class="flex items-center gap-3 rounded-2xl bg-tauf-green-light px-5 py-3">
                        <svg class="h-6 w-6 text-tauf-green" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>
                        <div>
                            <p class="text-xs text-tauf-gray">Vues</p>
                            <p class="text-sm font-bold text-tauf-green-dark">{{ number_format($event->views, 0, ',', ' ') }}</p>
                        </div>
                    </div>
                </div>

                @if ($event->cover)
                    <img src="{{ upload_url($event->cover) }}" alt="{{ $event->title }}" class="mb-8 w-full rounded-3xl object-cover">
                @endif

                <div class="prose-tauf">{!! $event->body ?: '<p>'.e($event->excerpt).'</p>' !!}</div>
            </article>

            <aside class="space-y-6">
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
                    <h3 class="font-display text-lg font-bold text-tauf-ink">Ajouter à l'agenda</h3>
                    <p class="mt-2 text-sm text-tauf-gray">Ne manquez pas cet événement.</p>
                    <a href="{{ route('contact') }}" class="btn-primary mt-4 w-full !py-2.5 text-xs">Plus d'informations</a>
                </div>
                @if ($others->isNotEmpty())
                    <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
                        <h3 class="font-display text-lg font-bold text-tauf-ink">Autres événements</h3>
                        <ul class="mt-4 space-y-3">
                            @foreach ($others as $other)
                                <li><a href="{{ route('events.show', $other) }}" class="text-sm text-tauf-gray hover:text-tauf-green">{{ $other->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </aside>
        </div>
    </section>
@endsection
