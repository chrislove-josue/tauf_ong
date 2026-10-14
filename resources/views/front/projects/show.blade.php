@extends('layouts.front')

@section('title', $project->title)

@section('meta_description', $project->excerpt ?: $project->title)

@section('og_image', upload_url($project->cover))

@section('content')
    <x-front.banner
        :title="$project->title"
        :subtitle="$project->excerpt"
        :image="$project->cover"
        :crumbs="['Réalisations' => route('projects.index'), $project->title => null]" />

    <section class="container-tauf py-16">
        <div class="grid gap-12 lg:grid-cols-3">
            <div class="lg:col-span-2 space-y-10">
                @if ($project->cover)
                    <img src="{{ upload_url($project->cover) }}" alt="{{ $project->title }}" class="w-full rounded-3xl object-cover">
                @endif

                @if ($project->indicators)
                    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3">
                        @foreach ($project->indicators as $indicator)
                            <div class="rounded-2xl bg-tauf-green-light p-5 text-center">
                                <div class="font-display text-2xl font-extrabold text-tauf-green">{{ $indicator['value'] ?? '' }}</div>
                                <p class="mt-1 text-xs font-medium text-tauf-green-dark">{{ $indicator['label'] ?? '' }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif

                @foreach (['context' => 'Contexte', 'objectives' => 'Objectifs', 'results' => 'Résultats'] as $field => $label)
                    @if ($project->$field)
                        <div>
                            <h2 class="section-title mb-4 !text-2xl">{{ $label }}</h2>
                            <div class="prose-tauf">{!! $project->$field !!}</div>
                        </div>
                    @endif
                @endforeach

                @if ($project->gallery)
                    <div>
                        <h2 class="section-title mb-4 !text-2xl">Galerie</h2>
                        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3">
                            @foreach ($project->gallery as $image)
                                <a href="{{ upload_url($image) }}" target="_blank" class="overflow-hidden rounded-2xl">
                                    <img src="{{ upload_url($image) }}" alt="" class="h-40 w-full object-cover transition hover:scale-105">
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <aside class="space-y-4">
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
                    <h3 class="font-display text-lg font-bold text-tauf-ink">Informations</h3>
                    <dl class="mt-4 space-y-3 text-sm">
                        @if ($project->location)
                            <div class="flex justify-between gap-4"><dt class="text-tauf-gray">Lieu</dt><dd class="font-semibold text-tauf-ink">{{ $project->location }}</dd></div>
                        @endif
                        @if ($project->started_at)
                            <div class="flex justify-between gap-4"><dt class="text-tauf-gray">Début</dt><dd class="font-semibold text-tauf-ink">{{ french_date($project->started_at) }}</dd></div>
                        @endif
                        @if ($project->ended_at)
                            <div class="flex justify-between gap-4"><dt class="text-tauf-gray">Fin</dt><dd class="font-semibold text-tauf-ink">{{ french_date($project->ended_at) }}</dd></div>
                        @endif
                    </dl>
                </div>
                @if ($others->isNotEmpty())
                    <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
                        <h3 class="font-display text-lg font-bold text-tauf-ink">Autres réalisations</h3>
                        <ul class="mt-4 space-y-3">
                            @foreach ($others as $other)
                                <li><a href="{{ route('projects.show', $other) }}" class="text-sm text-tauf-gray hover:text-tauf-green">{{ $other->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </aside>
        </div>
    </section>
@endsection
