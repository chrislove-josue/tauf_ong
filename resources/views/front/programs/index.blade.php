@extends('layouts.front')

@section('title', 'Nos programmes')

@section('content')
    <x-front.banner
        title="Nos programmes"
        subtitle="Des initiatives éducatives, culturelles et sociales pour la jeunesse béninoise."
        :crumbs="['Programmes' => null]" />

    <section class="container-tauf py-16">
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($programs as $program)
                <a href="{{ route('programs.show', $program) }}" class="card reveal group overflow-hidden">
                    <div class="card-media bg-tauf-green-light">
                        <img src="{{ upload_url($program->cover) }}" alt="{{ $program->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                    </div>
                    <div class="p-6">
                        <h2 class="font-display text-lg font-bold text-tauf-ink group-hover:text-tauf-green">{{ $program->title }}</h2>
                        @if ($program->subtitle)<p class="mt-1 text-sm font-medium text-tauf-gold-dark">{{ $program->subtitle }}</p>@endif
                        <p class="mt-3 line-clamp-3 text-sm text-tauf-gray">{{ $program->excerpt ?: Str::limit(strip_tags($program->body), 150) }}</p>
                    </div>
                </a>
            @empty
                <p class="col-span-full rounded-2xl bg-tauf-cream p-8 text-center text-tauf-gray">Aucun programme publié pour le moment.</p>
            @endforelse
        </div>
    </section>
@endsection
