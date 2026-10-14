@extends('layouts.front')

@section('title', 'Actualités')

@section('content')
    <x-front.banner
        title="Actualités"
        subtitle="Suivez l'actualité, les communiqués et les temps forts de l'ONG TAUF."
        :crumbs="['Actualités' => null]" />

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
@endsection
