@extends('layouts.front')

@section('title', 'Mission, vision et valeurs')

@section('content')
    <x-front.banner
        title="Mission, vision et valeurs"
        subtitle="Les principes qui guident notre engagement."
        :crumbs="['À propos' => route('about.index'), 'Mission, vision, valeurs' => null]" />

    <section class="container-tauf py-16">
        <div class="mx-auto max-w-4xl">
            @if ($page && $page->body)
                <div class="prose-tauf">{!! $page->body !!}</div>
            @else
                <div class="grid gap-6 sm:grid-cols-2">
                    <div class="card p-6">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-tauf-green-light text-tauf-green">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                        </div>
                        <h2 class="mt-4 font-display text-xl font-bold">Notre mission</h2>
                        <p class="mt-2 text-sm text-tauf-gray">Promouvoir l'éducation, la langue française et la culture, et accompagner l'épanouissement des jeunes à travers des programmes éducatifs, culturels et sociaux.</p>
                    </div>
                    <div class="card p-6">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-tauf-gold/20 text-tauf-gold-dark">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>
                        </div>
                        <h2 class="mt-4 font-display text-xl font-bold">Notre vision</h2>
                        <p class="mt-2 text-sm text-tauf-gray">{{ tauf_setting('about_vision', 'Un Bénin où chaque jeune a accès à une éducation de qualité et rayonne par sa maîtrise de la langue française et de la culture.') }}</p>
                    </div>
                </div>

                <div class="mt-10">
                    <h2 class="section-title mb-6">Nos valeurs</h2>
                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach (array_filter(array_map('trim', explode("\n", tauf_setting('about_values', "Éducation\nSolidarité\nExcellence\nFrancophonie\nIntégrité")))) as $i => $value)
                            <div class="flex items-center gap-3 rounded-2xl border border-gray-100 bg-white p-4 shadow-sm">
                                <span class="flex h-9 w-9 items-center justify-center rounded-full bg-tauf-green text-sm font-bold text-white">{{ $i + 1 }}</span>
                                <span class="font-semibold text-tauf-ink">{{ $value }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
