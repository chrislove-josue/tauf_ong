@extends('layouts.front')

@section('title', 'Nos partenaires')

@section('content')
    <x-front.banner
        title="Nos partenaires"
        subtitle="Ils soutiennent notre mission et nos programmes."
        :crumbs="['À propos' => route('about.index'), 'Partenaires' => null]" />

    <section class="container-tauf py-16">
        @forelse ($partners as $category => $items)
            @if ($category)
                <h2 class="mb-8 font-display text-xl font-bold text-tauf-ink">{{ $category }}</h2>
            @endif
            <div class="mb-12 grid grid-cols-2 gap-6 sm:grid-cols-3 lg:grid-cols-4">
                @foreach ($items as $partner)
                    <a href="{{ $partner->url ?: '#' }}" @if ($partner->url) target="_blank" rel="noopener" @endif
                       class="flex h-32 items-center justify-center rounded-2xl border border-gray-100 bg-white p-6 shadow-sm grayscale transition hover:shadow-lg hover:grayscale-0">
                        <img src="{{ upload_url($partner->logo) }}" alt="{{ $partner->name }}" class="max-h-16 max-w-full object-contain">
                    </a>
                @endforeach
            </div>
        @empty
            <p class="rounded-2xl bg-tauf-cream p-8 text-center text-tauf-gray">La liste de nos partenaires sera bientôt disponible.</p>
        @endforelse
    </section>
@endsection
