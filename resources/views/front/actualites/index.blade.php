@extends('layouts.front')

@section('title', 'Actualités & événements')

@section('content')
    <x-front.banner
        title="Actualités & événements"
        subtitle="Suivez l'actualité, les communiqués et les rendez-vous de l'ONG TAUF."
        :crumbs="['Actualités & événements' => null]" />

    <section class="container-tauf py-16">
        <div class="grid gap-12 lg:grid-cols-4">
            <div class="lg:col-span-3">
                @if ($posts->isEmpty())
                    <p class="rounded-2xl bg-tauf-cream p-8 text-center text-tauf-gray">Aucune actualité pour le moment.</p>
                @else
                    <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                        @foreach ($posts as $post)
                            <a href="{{ route('posts.show', $post) }}" class="card reveal group flex flex-col overflow-hidden">
                                <div class="aspect-[16/10] overflow-hidden">
                                    <img src="{{ upload_url($post->cover) }}" alt="{{ $post->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                </div>
                                <div class="flex flex-1 flex-col p-5">
                                    <div class="mb-2 flex items-center gap-2 text-xs text-tauf-gray">
                                        @if ($post->category)
                                            <span class="rounded-full bg-tauf-green-light px-2.5 py-0.5 font-semibold text-tauf-green">{{ $post->category->name }}</span>
                                        @endif
                                        <span>{{ french_date($post->published_at ?: $post->created_at, 'd M Y') }}</span>
                                    </div>
                                    <h2 class="font-display font-bold leading-snug text-tauf-ink group-hover:text-tauf-green">{{ $post->title }}</h2>
                                    <p class="mt-2 line-clamp-2 text-sm text-tauf-gray">{{ $post->excerpt }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="mt-10">{{ $posts->links() }}</div>
                @endif
            </div>

            <aside class="space-y-6">
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
                    <h3 class="font-display text-lg font-bold text-tauf-ink">Rechercher</h3>
                    <form action="{{ route('posts.index') }}" method="GET" class="mt-4 flex overflow-hidden rounded-full border border-gray-200">
                        <input type="search" name="q" value="{{ request('q') }}" placeholder="Mot-clé..." class="w-full bg-transparent px-4 py-2.5 text-sm focus:outline-none">
                        <button class="bg-tauf-green px-4 text-white"><svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.3-4.3"/></svg></button>
                    </form>
                </div>
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
                    <h3 class="font-display text-lg font-bold text-tauf-ink">Catégories</h3>
                    <ul class="mt-4 space-y-2 text-sm">
                        <li><a href="{{ route('posts.index') }}" class="flex justify-between text-tauf-gray hover:text-tauf-green"><span>Toutes</span></a></li>
                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('posts.index', ['categorie' => $category->slug]) }}"
                                   class="flex justify-between {{ request('categorie') === $category->slug ? 'font-semibold text-tauf-green' : 'text-tauf-gray hover:text-tauf-green' }}">
                                    <span>{{ $category->name }}</span>
                                    <span class="text-xs">{{ $category->posts_count ?? '' }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>
        </div>
    </section>

    <section class="bg-tauf-cream py-16">
        <div class="container-tauf">
            <div class="mb-8 flex flex-wrap items-end justify-between gap-4">
                <h2 class="section-title">Événements à venir</h2>
            </div>
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
                    <p class="col-span-full rounded-2xl bg-white p-8 text-center text-tauf-gray">Aucun événement à venir pour le moment.</p>
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
        </div>
    </section>
@endsection
