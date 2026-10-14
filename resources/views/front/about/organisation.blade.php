@extends('layouts.front')

@section('title', 'Organisation et gouvernance')

@section('content')
    <x-front.banner
        title="Organisation et gouvernance"
        subtitle="L'équipe qui fait vivre l'ONG TAUF au quotidien."
        :crumbs="['À propos' => route('about.index'), 'Organisation' => null]" />

    <section class="container-tauf py-16">
        @forelse ($members as $group => $people)
            <div class="mb-14">
                <h2 class="section-title mb-8">{{ \Illuminate\Support\Str::title(str_replace('_', ' ', $group)) }}</h2>
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($people as $member)
                        <div class="card reveal overflow-hidden text-center">
                            <div class="aspect-square overflow-hidden bg-tauf-green-light">
                                <img src="{{ upload_url($member->photo, 'images/placeholder.svg') }}" alt="{{ $member->name }}" class="h-full w-full object-cover">
                            </div>
                            <div class="p-5">
                                <h3 class="font-display font-bold text-tauf-ink">{{ $member->name }}</h3>
                                <p class="mt-1 text-sm font-medium text-tauf-green">{{ $member->role }}</p>
                                @if ($member->bio)
                                    <p class="mt-3 line-clamp-3 text-xs text-tauf-gray">{{ $member->bio }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <p class="rounded-2xl bg-tauf-cream p-8 text-center text-tauf-gray">Les informations sur l'organisation et la gouvernance seront bientôt disponibles.</p>
        @endforelse
    </section>
@endsection
