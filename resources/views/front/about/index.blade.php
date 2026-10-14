@extends('layouts.front')

@section('title', "Ã€ propos de l'ONG TAUF")

@section('content')
    <x-front.banner
        title="Ã€ propos de l'ONG TAUF"
        subtitle="Une organisation bÃ©ninoise au service de l'Ã©ducation, de la langue franÃ§aise et de la culture."
        :crumbs="['Ã€ propos' => null]" />

    <nav class="border-b border-gray-100 bg-white">
        <div class="container-tauf flex flex-wrap items-center justify-center gap-2 py-4">
            <a href="#presentation" class="rounded-full border border-gray-200 px-4 py-2 text-xs font-semibold text-tauf-ink transition hover:border-tauf-green hover:text-tauf-green">PrÃ©sentation</a>
            <a href="#histoire" class="rounded-full border border-gray-200 px-4 py-2 text-xs font-semibold text-tauf-ink transition hover:border-tauf-green hover:text-tauf-green">Notre histoire</a>
            <a href="#mission" class="rounded-full border border-gray-200 px-4 py-2 text-xs font-semibold text-tauf-ink transition hover:border-tauf-green hover:text-tauf-green">Mission, vision, valeurs</a>
            <a href="#organisation" class="rounded-full border border-gray-200 px-4 py-2 text-xs font-semibold text-tauf-ink transition hover:border-tauf-green hover:text-tauf-green">Organisation & gouvernance</a>
        </div>
    </nav>

    <section id="presentation" class="container-tauf scroll-mt-32 py-16 sm:py-20">
        <div class="grid gap-12 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <span class="eyebrow"><span class="h-px w-8 bg-tauf-gold"></span>PrÃ©sentation</span>
                <div class="prose-tauf mt-4">
                    @if ($page && $page->body)
                        {!! $page->body !!}
                        <p>L'ONG TAUF est une organisation non gouvernementale bÃ©ninoise engagÃ©e dans la promotion de l'Ã©ducation, de la langue franÃ§aise et de la culture, notamment Ã  travers l'organisation de la Â« DictÃ©e PGL BÃ©nin Â» et d'autres programmes Ã  vocation Ã©ducative, culturelle et sociale.</p>
                        <p>Ã€ travers ses actions de terrain, ses partenariats et ses rÃ©alisations, l'ONG TAUF Å“uvre pour l'Ã©panouissement des jeunes et le rayonnement de la francophonie au BÃ©nin.</p>
                    @endif
                </div>
            </div>

            <aside class="space-y-4">
                <div class="rounded-2xl bg-tauf-cream p-6">
                    <h3 class="font-display text-lg font-bold text-tauf-ink">Nos valeurs</h3>
                    <ul class="mt-4 space-y-2.5 text-sm text-tauf-gray">
                        @forelse (array_filter(array_map('trim', explode("\n", tauf_setting('about_values', "Ã‰ducation\nSolidaritÃ©\nExcellence\nFrancophonie\nIntÃ©gritÃ©")))) as $value)
                            <li class="flex items-center gap-2">
                                <span class="h-2 w-2 rounded-full bg-tauf-gold"></span>{{ $value }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="rounded-2xl bg-tauf-green p-6 text-white">
                    <h3 class="font-display text-lg font-bold">Nous rejoindre</h3>
                    <p class="mt-2 text-sm text-white/85">Envie de contribuer Ã  notre mission ? Devenez bÃ©nÃ©vole ou partenaire.</p>
                    <a href="{{ route('join') }}" class="btn-gold mt-4 w-full !py-2.5 text-xs">Devenir bÃ©nÃ©vole</a>
                </div>
            </aside>
        </div>
    </section>

    <section id="histoire" class="scroll-mt-32 bg-tauf-cream py-16 sm:py-20">
        <div class="container-tauf">
            <span class="eyebrow"><span class="h-px w-8 bg-tauf-gold"></span>Notre histoire</span>
            <div class="prose-tauf mx-auto mt-4 max-w-3xl">
                @if ($history && $history->body)
                    {!! $history->body !!}
                    <p>FondÃ©e au BÃ©nin, l'ONG TAUF est nÃ©e de la volontÃ© d'accompagner les jeunes dans leur parcours Ã©ducatif et de promouvoir la langue franÃ§aise Ã  travers des initiatives fÃ©dÃ©ratrices comme la Â« DictÃ©e PGL BÃ©nin Â».</p>
                    <p>Au fil des annÃ©es, l'organisation a dÃ©veloppÃ© des programmes Ã©ducatifs, culturels et sociaux, nouÃ© des partenariats et fÃ©dÃ©rÃ© des milliers de participants autour de la passion des mots et de la connaissance.</p>
                    <h2>Nos grandes Ã©tapes</h2>
                    <ul>
                        <li>CrÃ©ation de l'ONG TAUF et dÃ©finition de sa mission.</li>
                        <li>Lancement de la Â« DictÃ©e PGL BÃ©nin Â» et de ses premiÃ¨res Ã©ditions.</li>
                        <li>DÃ©ploiement de nouveaux programmes Ã©ducatifs et culturels.</li>
                        <li>DÃ©veloppement de partenariats nationaux et internationaux.</li>
                    </ul>
                @endif
            </div>
        </div>
    </section>

    <section id="mission" class="container-tauf scroll-mt-32 py-16 sm:py-20">
        <span class="eyebrow"><span class="h-px w-8 bg-tauf-gold"></span>Mission, vision, valeurs</span>
        <div class="mt-4">
            @if ($mission && $mission->body)
                <div class="prose-tauf max-w-4xl">{!! $mission->body !!}</div>
            @else
                <div class="grid max-w-4xl gap-6 sm:grid-cols-2">
                    <div class="card p-6">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-tauf-green-light text-tauf-green">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                        </div>
                        <h2 class="mt-4 font-display text-xl font-bold">Notre mission</h2>
                        <p class="mt-2 text-sm text-tauf-gray">Promouvoir l'Ã©ducation, la langue franÃ§aise et la culture, et accompagner l'Ã©panouissement des jeunes Ã  travers des programmes Ã©ducatifs, culturels et sociaux.</p>
                    </div>
                    <div class="card p-6">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-tauf-gold/20 text-tauf-gold-dark">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>
                        </div>
                        <h2 class="mt-4 font-display text-xl font-bold">Notre vision</h2>
                        <p class="mt-2 text-sm text-tauf-gray">{{ tauf_setting('about_vision', 'Un BÃ©nin oÃ¹ chaque jeune a accÃ¨s Ã  une Ã©ducation de qualitÃ© et rayonne par sa maÃ®trise de la langue franÃ§aise et de la culture.') }}</p>
                    </div>
                </div>

                <div class="mt-10">
                    <h2 class="section-title mb-6">Nos valeurs</h2>
                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach (array_filter(array_map('trim', explode("\n", tauf_setting('about_values', "Ã‰ducation\nSolidaritÃ©\nExcellence\nFrancophonie\nIntÃ©gritÃ©")))) as $i => $value)
                            <div class="flex items-center gap-3 rounded-2xl border border-gray-100 bg-white p-4 shadow-sm">
                                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-tauf-green text-sm font-bold text-white">{{ $i + 1 }}</span>
                                <span class="font-semibold text-tauf-ink">{{ $value }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>

    <section id="organisation" class="scroll-mt-32 bg-tauf-cream py-16 sm:py-20">
        <div class="container-tauf">
            <span class="eyebrow"><span class="h-px w-8 bg-tauf-gold"></span>Organisation & gouvernance</span>
            <p class="mt-2 max-w-2xl text-sm text-tauf-gray">L'Ã©quipe qui fait vivre l'ONG TAUF au quotidien.</p>
            <div class="mt-8 space-y-14">
                @forelse ($members as $group => $people)
                    <div>
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
                    <p class="rounded-2xl bg-white p-8 text-center text-tauf-gray">Les informations sur l'organisation et la gouvernance seront bientÃ´t disponibles.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="bg-tauf-green-dark py-14 text-center text-white">
        <div class="container-tauf">
            <div class="mx-auto max-w-2xl">
                <h2 class="font-display text-3xl font-extrabold">Envie de nous rejoindre ?</h2>
                <p class="mx-auto mt-4 max-w-2xl text-white/85">Votre Ã©nergie et vos compÃ©tences sont prÃ©cieuses pour faire vivre nos programmes.</p>
                <div class="mt-8 flex flex-wrap justify-center gap-3">
                    <a href="{{ route('join') }}" class="btn-gold">Devenir bÃ©nÃ©vole</a>
                    <a href="{{ route('support') }}" class="btn-outline">Faire un don</a>
                </div>
            </div>
        </div>
    </section>
@endsection
