@extends('layouts.front')

@section('title', $post->title)

@section('meta_description', $post->meta_description ?: $post->excerpt ?: $post->title)

@section('og_image', upload_url($post->cover))

@section('content')
    <x-front.banner
        :title="$post->title"
        :subtitle="$post->excerpt"
        :image="$post->cover"
        :crumbs="['Actualités' => route('posts.index'), Str::limit($post->title, 40) => null]" />

    <section class="container-tauf py-16">
        <div class="grid gap-12 lg:grid-cols-3">
            <article class="lg:col-span-2">
                <div class="mb-6 flex flex-wrap items-center gap-4 text-sm text-tauf-gray">
                    @if ($post->category)
                        <span class="rounded-full bg-tauf-green-light px-3 py-1 font-semibold text-tauf-green">{{ $post->category->name }}</span>
                    @endif
                    <span class="inline-flex items-center gap-1.5">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                        {{ french_date($post->published_at ?: $post->created_at, 'd F Y') }}
                    </span>
                    @if ($post->author)
                        <span class="inline-flex items-center gap-1.5"><svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21v-1a6 6 0 016-6h4a6 6 0 016 6v1"/></svg>{{ $post->author->name }}</span>
                    @endif
                </div>

                @if ($post->cover)
                    <img src="{{ upload_url($post->cover) }}" alt="{{ $post->title }}" class="mb-8 w-full rounded-3xl object-cover">
                @endif

                <div class="prose-tauf">{!! $post->body !!}</div>

                <div class="mt-10 flex items-center gap-3 border-t border-gray-100 pt-6">
                    <span class="text-sm font-semibold text-tauf-ink">Partager :</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" class="flex h-9 w-9 items-center justify-center rounded-full bg-tauf-green-light text-tauf-green transition hover:bg-tauf-green hover:text-white"><svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><use href="#icon-facebook"/></svg></a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}" target="_blank" rel="noopener" class="flex h-9 w-9 items-center justify-center rounded-full bg-tauf-green-light text-tauf-green transition hover:bg-tauf-green hover:text-white"><svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><use href="#icon-twitter"/></svg></a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" class="flex h-9 w-9 items-center justify-center rounded-full bg-tauf-green-light text-tauf-green transition hover:bg-tauf-green hover:text-white"><svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><use href="#icon-linkedin"/></svg></a>
                    <a href="https://wa.me/?text={{ urlencode($post->title.' '.url()->current()) }}" target="_blank" rel="noopener" class="flex h-9 w-9 items-center justify-center rounded-full bg-tauf-green-light text-tauf-green transition hover:bg-tauf-green hover:text-white"><svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 11.5a8.5 8.5 0 01-12.4 7.5L3 21l2-5.1A8.5 8.5 0 1121 11.5z"/></svg></a>
                </div>
            </article>

            <aside class="space-y-6">
                @if ($related->isNotEmpty())
                    <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
                        <h3 class="font-display text-lg font-bold text-tauf-ink">À lire aussi</h3>
                        <ul class="mt-4 space-y-4">
                            @foreach ($related as $item)
                                <li>
                                    <a href="{{ route('posts.show', $item) }}" class="group flex gap-3">
                                        <img src="{{ upload_url($item->cover) }}" alt="" class="h-16 w-16 rounded-lg object-cover">
                                        <span class="text-sm font-medium text-tauf-ink group-hover:text-tauf-green">{{ Str::limit($item->title, 60) }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="rounded-2xl bg-tauf-green p-6 text-white">
                    <h3 class="font-display text-lg font-bold">Newsletter</h3>
                    <p class="mt-2 text-sm text-white/85">Recevez nos actualités directement par e-mail.</p>
                    <form action="{{ route('newsletter.store') }}" method="POST" class="mt-4">
                        @csrf
                        <input type="email" name="email" required placeholder="Votre e-mail" class="w-full rounded-full border-0 px-4 py-2.5 text-sm text-tauf-ink focus:outline-none">
                        <button class="btn-gold mt-3 w-full !py-2.5 text-xs">S'inscrire</button>
                    </form>
                </div>
            </aside>
        </div>
    </section>
@endsection
