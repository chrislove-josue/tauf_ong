@extends('layouts.front')

@section('title', 'Accueil')

@section('content')
    {{-- Bannière / slider --}}
    <section data-slider class="relative min-h-[520px] overflow-hidden bg-tauf-green-dark sm:min-h-[600px]">
        @php
            $defaultSlides = collect([
                [
                    'title' => 'Ensemble pour l\'éducation et la francophonie au Bénin',
                    'subtitle' => 'ONG TAUF',
                    'text' => 'Nous œuvrons pour l\'épanouissement des jeunes à travers des programmes éducatifs, culturels et sociaux.',
                ],
            ]);
            $heroSlides = $slides->isNotEmpty() ? $slides : $defaultSlides;
        @endphp

        @forelse ($heroSlides as $slide)
            <div data-slide class="absolute inset-0 transition-opacity duration-1000">
                @if (! empty($slide->image))
                    <img src="{{ upload_url($slide->image) }}" alt="" class="h-full w-full object-cover">
                @elseif ($slide instanceof \App\Models\Slide)
                    <img src="{{ asset('images/placeholder.svg') }}" alt="" class="h-full w-full object-cover">
                @endif
                <div class="absolute inset-0 bg-gradient-to-r from-tauf-green-dark/95 via-tauf-green-dark/80 to-tauf-green/40"></div>
            </div>
        @empty
        @endforelse

        <div class="container-tauf relative flex min-h-[520px] items-center py-20 sm:min-h-[600px]">
            <div class="max-w-3xl text-white">
                @php $first = $heroSlides->first(); @endphp
                <span class="eyebrow !text-tauf-gold">
                    <span class="h-px w-8 bg-tauf-gold"></span>
                    {{ is_object($first) ? ($first->subtitle ?: 'Organisation Non Gouvernementale') : ($first['subtitle'] ?? 'ONG TAUF') }}
                </span>
                <h1 class="font-display text-4xl font-extrabold leading-tight sm:text-5xl lg:text-6xl">
                    {{ is_object($first) ? $first->title : $first['title'] }}
                </h1>
                <p class="mt-6 max-w-2xl text-lg text-white/85">
                    {{ is_object($first) ? ($first->text ?: tauf_setting('about_mission')) : $first['text'] }}
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('programs.index') }}" class="btn-gold">Découvrir nos programmes</a>
                    <a href="{{ route('support') }}" class="btn-outline">Nous soutenir</a>
                </div>
            </div>
        </div>

        @if ($heroSlides->count() > 1)
            <div class="absolute bottom-8 left-1/2 z-10 flex -translate-x-1/2 gap-2">
                @foreach ($heroSlides as $i => $s)
                    <span class="h-2 w-2 rounded-full bg-white/40"></span>
                @endforeach
            </div>
        @endif
    </section>

    {{-- Mission --}}
    <section class="container-tauf py-16 sm:py-20">
        <div class="grid items-center gap-12 lg:grid-cols-2">
            <div class="reveal">
                <span class="eyebrow"><span class="h-px w-8 bg-tauf-gold"></span>Qui sommes-nous</span>
                <h2 class="section-title">Une ONG engagée pour la jeunesse et la culture</h2>
                <p class="mt-5 text-tauf-gray">
                    {{ tauf_setting('about_mission', "L'ONG TAUF est une organisation non gouvernementale béninoise engagée dans la promotion de l'éducation, de la langue française et de la culture, notamment à travers l'organisation de la « Dictée PGL Bénin » et d'autres programmes à vocation éducative, culturelle et sociale.") }}
                </p>
                <ul class="mt-6 space-y-3">
                    @foreach (['Promotion de l\'éducation et de la lecture', 'Rayonnement de la francophonie au Bénin', 'Accompagnement des jeunes et des écoles'] as $item)
                        <li class="flex items-start gap-3">
                            <span class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-tauf-green-light text-tauf-green">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span class="text-tauf-gray">{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('about.index') }}" class="btn-outline-dark mt-8">En savoir plus sur nous</a>
            </div>
            <div class="reveal grid grid-cols-2 gap-4">
                <img src="{{ asset('images/placeholder.svg') }}" alt="Activités ONG TAUF" class="col-span-2 h-56 w-full rounded-3xl object-cover">
                <img src="{{ asset('images/placeholder.svg') }}" alt="Programmes éducatifs" class="h-40 w-full rounded-3xl object-cover">
                <img src="{{ asset('images/placeholder.svg') }}" alt="Dictée PGL Bénin" class="h-40 w-full rounded-3xl object-cover">
            </div>
        </div>
    </section>

    {{-- Chiffres clés --}}
    @if ($stats->isNotEmpty())
        <section class="relative overflow-hidden bg-tauf-green py-16 text-white">
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 20% 20%, #fff 1px, transparent 1px); background-size: 28px 28px;"></div>
            <div class="container-tauf relative">
                <div class="grid grid-cols-2 gap-8 lg:grid-cols-4">
                    @foreach ($stats as $stat)
                        <div class="reveal text-center">
                            <div class="font-display text-4xl font-extrabold text-tauf-gold sm:text-5xl">
                                <span data-counter="{{ $stat->value }}">{{ $stat->value }}</span>{{ $stat->suffix }}
                            </div>
                            <p class="mt-2 text-sm font-medium text-white/85">{{ $stat->label }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Programmes --}}
    @if ($programs->isNotEmpty())
        <section class="container-tauf py-16 sm:py-20">
            <div class="mb-12 text-center">
                <span class="eyebrow justify-center"><span class="h-px w-8 bg-tauf-gold"></span>Nos programmes<span class="h-px w-8 bg-tauf-gold"></span></span>
                <h2 class="section-title">Ce que nous faisons</h2>
                <p class="mx-auto mt-4 max-w-2xl text-tauf-gray">Des initiatives éducatives, culturelles et sociales au service des jeunes et des communautés.</p>
            </div>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($programs as $program)
                    <a href="{{ route('programs.show', $program) }}" class="card reveal group overflow-hidden">
                        <div class="card-media bg-tauf-green-light">
                            <img src="{{ upload_url($program->cover) }}" alt="{{ $program->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                        </div>
                        <div class="p-6">
                            <h3 class="font-display text-lg font-bold text-tauf-ink group-hover:text-tauf-green">{{ $program->title }}</h3>
                            <p class="mt-2 line-clamp-3 text-sm text-tauf-gray">{{ $program->excerpt ?: Str::limit(strip_tags($program->body), 130) }}</p>
                            <span class="mt-4 inline-flex items-center gap-1 text-sm font-semibold text-tauf-green">
                                En savoir plus
                                <svg class="h-4 w-4 transition group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    {{-- Réalisations --}}
    @if ($projects->isNotEmpty())
        <section class="bg-tauf-cream py-16 sm:py-20">
            <div class="container-tauf">
                <div class="mb-10 flex flex-wrap items-end justify-between gap-4">
                    <div>
                        <span class="eyebrow"><span class="h-px w-8 bg-tauf-gold"></span>Nos réalisations</span>
                        <h2 class="section-title">L'impact de nos actions</h2>
                    </div>
                    <a href="{{ route('projects.index') }}" class="btn-outline-dark">Toutes les réalisations</a>
                </div>
                <div class="grid gap-6 md:grid-cols-3">
                    @foreach ($projects as $project)
                        <a href="{{ route('projects.show', $project) }}" class="card reveal group overflow-hidden">
                            <div class="card-media">
                                <img src="{{ upload_url($project->cover) }}" alt="{{ $project->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                            </div>
                            <div class="p-5">
                                @if ($project->location)
                                    <span class="text-xs font-semibold uppercase tracking-wider text-tauf-gold-dark">{{ $project->location }}</span>
                                @endif
                                <h3 class="mt-1 font-display font-bold text-tauf-ink group-hover:text-tauf-green">{{ $project->title }}</h3>
                                <p class="mt-2 line-clamp-2 text-sm text-tauf-gray">{{ $project->excerpt }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Actualités --}}
    @if ($posts->isNotEmpty())
        <section class="container-tauf py-16 sm:py-20">
            <div class="mb-10 flex flex-wrap items-end justify-between gap-4">
                <div>
                    <span class="eyebrow"><span class="h-px w-8 bg-tauf-gold"></span>Actualités</span>
                    <h2 class="section-title">Nos dernières nouvelles</h2>
                </div>
                <a href="{{ route('posts.index') }}" class="btn-outline-dark">Toutes les actualités</a>
            </div>
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
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
                            <h3 class="font-display font-bold leading-snug text-tauf-ink group-hover:text-tauf-green">{{ $post->title }}</h3>
                            <p class="mt-2 line-clamp-2 text-sm text-tauf-gray">{{ $post->excerpt }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    {{-- Événements + Témoignages --}}
    <section class="bg-tauf-cream py-16 sm:py-20">
        <div class="container-tauf grid gap-12 lg:grid-cols-2">
            <div>
                <span class="eyebrow"><span class="h-px w-8 bg-tauf-gold"></span>Agenda</span>
                <h2 class="section-title mb-6">Prochains événements</h2>
                <div class="space-y-4">
                    @forelse ($events as $event)
                        <a href="{{ route('events.show', $event) }}" class="card flex gap-4 p-4">
                            <div class="flex h-16 w-16 shrink-0 flex-col items-center justify-center rounded-xl bg-tauf-green text-white">
                                <span class="text-xl font-extrabold leading-none">{{ $event->starts_at->format('d') }}</span>
                                <span class="text-[10px] uppercase">{{ french_date($event->starts_at, 'M') }}</span>
                            </div>
                            <div>
                                <h3 class="font-display font-bold text-tauf-ink">{{ $event->title }}</h3>
                                <p class="mt-1 text-xs text-tauf-gray">
                                    {{ $event->starts_at->format('H:i') }}@if ($event->location) · {{ $event->location }}@endif
                                </p>
                            </div>
                        </a>
                    @empty
                        <p class="rounded-2xl bg-white p-6 text-sm text-tauf-gray">Aucun événement à venir pour le moment. Revenez bientôt !</p>
                    @endforelse
                </div>
            </div>

<div>
                <span class="eyebrow"><span class="h-px w-8 bg-tauf-gold"></span>Témoignages</span>
                <h2 class="section-title mb-6">Ils nous font confiance</h2>
                @if ($testimonials->isEmpty())
                    <p class="rounded-2xl bg-white p-6 text-sm text-tauf-gray">Les témoignages seront bientôt disponibles.</p>
                @else
                    <div data-slider class="relative overflow-hidden rounded-3xl bg-white shadow-sm">
                        <div data-slides class="flex transition-transform duration-500 ease-in-out">
                            @foreach ($testimonials as $testimonial)
                                <div class="min-w-full p-8 sm:p-10">
                                    <blockquote class="flex h-full flex-col justify-between">
                                        <div>
                                            <svg class="h-10 w-10 text-tauf-gold" fill="currentColor" viewBox="0 0 24 24"><path d="M7 7h4v4H9c0 2 0 3 2 4v2c-3 0-4-2-4-5V7zm8 0h4v4h-2c0 2 0 3 2 4v2c-3 0-4-2-4-5V7z"/></svg>
                                            <p class="mt-6 text-base leading-relaxed text-tauf-ink">{{ $testimonial->content }}</p>
                                        </div>
                                        <footer class="mt-8 flex items-center gap-4">
                                            <img src="{{ upload_url($testimonial->photo, "images/placeholder.svg") }}" alt="{{ $testimonial->name }}" class="h-12 w-12 rounded-full object-cover ring-2 ring-tauf-gold/30">
                                            <div>
                                                <p class="font-display text-base font-bold text-tauf-ink">{{ $testimonial->name }}</p>
                                                @if ($testimonial->role)
                                                    <p class="text-sm text-tauf-gray">{{ $testimonial->role }}</p>
                                                @endif
                                            </div>
                                        </footer>
                                    </blockquote>
                                </div>
                            @endforeach
                        </div>
                        @if ($testimonials->count() > 1)
                            <div class="absolute inset-x-0 bottom-6 flex items-center justify-center gap-3">
                                <button data-prev class="flex h-9 w-9 items-center justify-center rounded-full border border-gray-200 bg-white/90 text-tauf-ink shadow-sm transition hover:bg-tauf-green hover:text-white">
                                    <svg class="h-5 w-5 -translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
                                </button>
                                <div data-dots class="flex items-center gap-2"></div>
                                <button data-next class="flex h-9 w-9 items-center justify-center rounded-full border border-gray-200 bg-white/90 text-tauf-ink shadow-sm transition hover:bg-tauf-green hover:text-white">
                                    <svg class="h-5 w-5 translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 6l6 6-6 6"/></svg>
                                </button>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </section>
                <h2 class="font-display text-3xl font-extrabold sm:text-4xl">Soutenez nos actions</h2>
                <p class="mx-auto mt-4 max-w-2xl text-white/85">Votre don, votre bénévolat ou votre partenariat nous permet de faire grandir l'éducation et la francophonie au Bénin.</p>
                <div class="mt-8 flex flex-wrap justify-center gap-3">
                    <a href="{{ route('support') }}" class="btn-gold">Faire un don</a>
                    <a href="{{ route('join') }}" class="btn-outline">Devenir bénévole</a>
                </div>
            </div>
        </div>
    </section>
@endsection
