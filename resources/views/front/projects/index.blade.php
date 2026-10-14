@extends('layouts.front')

@section('title', 'Nos réalisations')

@section('content')
    <x-front.banner
        title="Nos réalisations"
        subtitle="Découvrez les projets menés par l'ONG TAUF et leur impact."
        :crumbs="['Réalisations' => null]" />

    <section class="container-tauf py-16">
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($projects as $project)
                <a href="{{ route('projects.show', $project) }}" class="card reveal group overflow-hidden">
                    <div class="card-media">
                        <img src="{{ upload_url($project->cover) }}" alt="{{ $project->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                    </div>
                    <div class="p-6">
                        @if ($project->location)
                            <span class="inline-flex items-center gap-1 text-xs font-semibold uppercase tracking-wider text-tauf-gold-dark">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 21s-7-5.5-7-11a7 7 0 1114 0c0 5.5-7 11-7 11z"/><circle cx="12" cy="10" r="2.5"/></svg>
                                {{ $project->location }}
                            </span>
                        @endif
                        <h2 class="mt-1 font-display text-lg font-bold text-tauf-ink group-hover:text-tauf-green">{{ $project->title }}</h2>
                        <p class="mt-2 line-clamp-3 text-sm text-tauf-gray">{{ $project->excerpt }}</p>
                    </div>
                </a>
            @empty
                <p class="col-span-full rounded-2xl bg-tauf-cream p-8 text-center text-tauf-gray">Aucune réalisation publiée pour le moment.</p>
            @endforelse
        </div>
        <div class="mt-10">{{ $projects->links() }}</div>
    </section>
@endsection
