@extends('layouts.front')

@section('title', 'Événements & agenda')

@section('content')
    <x-front.banner
        title="Événements & agenda"
        subtitle="Retrouvez nos prochains rendez-vous et nos temps forts."
        :crumbs="['Événements' => null]" />

    <section class="container-tauf py-16">
        <h2 class="section-title mb-8">À venir</h2>
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($upcoming as $event)
                <a href="{{ route('events.show', $event) }}" class="card reveal group overflow-hidden">
                    <div class="relative">
                        <div class="card-media">
                            <img src="{{ upload_url($event->cover) }}" alt="{{ $event->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                        </div>
                        <div class="absolute left-4 top-4 flex h-16 w-16 flex-col items-center justify-center rounded-xl bg-tauf-red text-white shadow-lg">
                            <span class="text-xl font-extrabold leading-none">{{ $event->starts_at->format('d') }}</span>
                            <span class="text-[10px] uppercase">{{ french_date($event->starts_at, 'M') }}</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-display text-lg font-bold text-tauf-ink group-hover:text-tauf-green">{{ $event->title }}</h3>
                        <p class="mt-2 flex items-center gap-2 text-xs text-tauf-gray">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                            {{ $event->starts_at->format('H:i') }}@if ($event->location) · {{ $event->location }}@endif
                        </p>
                        <p class="mt-3 line-clamp-2 text-sm text-tauf-gray">{{ $event->excerpt }}</p>
                    </div>
                </a>
            @empty
                <p class="col-span-full rounded-2xl bg-tauf-cream p-8 text-center text-tauf-gray">Aucun événement à venir pour le moment.</p>
            @endforelse
        </div>

        @if ($past->isNotEmpty())
            <h2 class="section-title mb-8 mt-16">Événements passés</h2>
            <div class="space-y-4">
                @foreach ($past as $event)
                    <a href="{{ route('events.show', $event) }}" class="card flex flex-col gap-4 p-5 sm:flex-row sm:items-center">
                        <div class="flex h-16 w-16 shrink-0 flex-col items-center justify-center rounded-xl bg-tauf-cream text-tauf-ink">
                            <span class="text-xl font-extrabold leading-none">{{ $event->starts_at->format('d') }}</span>
                            <span class="text-[10px] uppercase">{{ french_date($event->starts_at, 'M') }}</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-display font-bold text-tauf-ink">{{ $event->title }}</h3>
                            <p class="mt-1 text-xs text-tauf-gray">{{ $event->location }}</p>
                        </div>
                        <span class="text-sm font-semibold text-tauf-green">Voir plus</span>
                    </a>
                @endforeach
            </div>
            <div class="mt-8">{{ $past->links() }}</div>
        @endif
    </section>
@endsection
