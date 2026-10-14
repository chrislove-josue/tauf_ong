@import('layouts.front')

@section('title', "À propos de l'ONG TAUF")

@section('content')
    <x-front.banner
        title="À propos de l'ONG TAUF"
        subtitle="Une organisation béninoise au service de l'éducation, de la langue française et de la culture."
        :crumbs="['À propos' => null]" />

    <nav class="border-b border-gray-100 bg-white">
        <div class="container-tauf flex flex-wrap items-center justify-center gap-2 py-4">
            <a href="#presentation" class="rounded-full border border-gray-200 px-4 py-2 text-xs font-semibold text-tauf-ink transition hover:border-tauf-green hover:text-tauf-green">Présentation</a>
            <a href="#histoire" class="rounded-full border border-gray-200 px-4 py-2 text-xs font-semibold text-tauf-ink transition hover:border-tauf-green hover:text-tauf-green">Notre histoire</a>
            <a href="#mission" class="rounded-full border border-gray-200 px-4 py-2 text-xs font-semibold text-tauf-ink transition hover:border-tauf-green hover:text-tauf-green">Mission, vision, valeurs</a>
            <a href="#organisation" class="rounded-full border border-gray-200 px-4 py-2 text-xs font-semibold text-tauf-ink transition hover:border-tauf-green hover:text-tauf-green">Organisation & gouvernance</a>
            <a href="#partenaires" class="rounded-full border border-gray-200 px-4 py-2 text-xs font-semibold text-tauf-ink transition hover:border-tauf-green hover:text-tauf-green">Nos partenaires</a>
        </div>
    </nav>

    <section id="presentation" class="container-tauf scroll-mt-24 py-16 sm:py-20">
        <div class="grid gap-12 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <span class="eyebrow"><span class="h-px w-8 bg-tauf-gold"></span>Présentation</span>
                <div class="prose-tauf mt-4">
                    @if ($page && $page->body)
                        {!! $page->body !!}
                        <p>L'ONG TAUF est une organisation non gouvernementale béninoise engagée dans la promotion de l'éducation, de la langue française et de la culture, notamment à travers l'organisation de la « Dictée PGL Bénin » et d'autres programmes à vocation éducative, culturelle et sociale.</p>
                        <p>À travers ses actions de terrain, ses partenariats et ses réalisations, l'ONG TAUF œuvre pour l'épanouissement des jeunes et le rayonnement de la francophonie au Bénin.</p>
                    @endif
                </div>
            </div>

            <aside class="space-y-4">
                <div class="rounded-2xl bg-tauf-cream p-6">
                    <h3 class="font-display text-lg font-bold text-tauf-ink">Nos valeurs</h3>
                    <ul class="mt-4 space-y-2.5 text-sm text-tauf-gray">
                        @forelse (array_filter(array_map('trim', explode("\n", tauf_setting('about_values', "Éducation\nSolidarité\nExcellence\nFrancophonie\nIntégrité")))) as $value)
                            <li class="flex items-center gap-2">
                                <span class="h-2 w-2 rounded-full bg-tauf-gold"></span>{{ $value }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="rounded-2xl bg-tauf-green p-6 text-white">
                    <h3 class="font-display text-lg font-bold">Nous rejoindre</h3>
                    <p class="mt-2 text-sm text-white/85">Envie de contribuer à notre mission ? Devenez bénévole ou partenaire.</p>
                    <a href="{{ route('join') }}" class="btn-gold mt-4 w-full !py-2.5 text-xs">Devenir bénévole</a>
                </div>
            </aside>
        </div>
    </section>

    <section id="histoire" class="scroll-mt-24 bg-tauf-cream py-16 sm:py-20">
        <div class="container-tauf">
            <span class="eyebrow"><span class="h-px w-8 bg-tauf-gold"></span>Notre histoire</span>
            <div class="prose-tauf mx-auto mt-4 max-w-3xl">
                @if ($history && $history->body)
                    {!! $history->body !!}
                    <p>Fondée au Bénin, l'ONG TAUF est née de la volonté d'accompagner les jeunes dans leur parcours éducatif et de promouvoir la langue française à travers des initiatives fédératrices comme la « Dictée PGL Bénin ».</p>
                    <p>Au fil des années, l'organisation a développé des programmes éducatifs, culturels et sociaux, noué des partenariats et fédéré des milliers de participants autour de la passion des mots et de la connaissance.</p>
                    <h2>Nos grandes étapes</h2>
                    <ul>
                        <li>Création de l'ONG TAUF et définition de sa mission.</li>
                        <li>Lancement de la « Dictée PGL Bénin » et de ses premières éditions.</li>
                        <li>Déploiement de nouveaux programmes éducatifs et culturels.</li>
                        <li>Développement de partenariats nationaux et internationaux.</li>
                    </ul>
                @endif
            </div>
        </div>
    </section>

    <section id="mission" class="container-tauf scroll-mt-24 py-16 sm:py-20">
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
                                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-tauf-green text-sm font-bold text-white">{{ $i + 1 }}</span>
                                <span class="font-semibold text-tauf-ink">{{ $value }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>

    <section id="organisation" class="scroll-mt-24 bg-tauf-cream py-16 sm:py-20">
        <div class="container-tauf">
            <span class="eyebrow"><span class="h-px w-8 bg-tauf-gold"></span>Organisation & gouvernance</span>
            <p class="mt-2 max-w-2xl text-sm text-tauf-gray">L'équipe qui fait vivre l'ONG TAUF au quotidien.</p>
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
                    <p class="rounded-2xl bg-white p-8 text-center text-tauf-gray">Les informations sur l'organisation et la gouvernance seront bientôt disponibles.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section id="partenaires" class="container-tauf scroll-mt-24 py-16 sm:py-20">
        <span class="eyebrow"><span class="h-px w-8 bg-tauf-gold"></span>Nos partenaires</span>
        <p class="mt-2 max-w-2xl text-sm text-tauf-gray">Ils soutiennent notre mission et nos programmes.</p>
        <div class="mt-8 space-y-12">
            @forelse ($partners as $category => $items)
                <div>
                    @if ($category)
                        <h2 class="mb-8 font-display text-xl font-bold text-tauf-ink">{{ $category }}</h2>
                    @endif
                    <div class="grid grid-cols-2 gap-6 sm:grid-cols-3 lg:grid-cols-4">
                        @foreach ($items as $partner)
                            <a href="{{ $partner->url ?: '#' }}" @if ($partner->url) target="_blank" rel="noopener" @endif
                               class="flex h-32 items-center justify-center rounded-2xl border border-gray-100 bg-white p-6 shadow-sm grayscale transition hover:shadow-lg hover:grayscale-0">
                                <img src="{{ upload_url($partner->logo) }}" alt="{{ $partner->name }}" class="max-h-16 max-w-full object-contain">
                            </a>
                        @endforeach
                    </div>
                </div>
            @empty
                <p class="rounded-2xl bg-tauf-cream p-8 text-center text-tauf-gray">La liste de nos partenaires sera bientôt disponible.</p>
            @endforelse
        </div>
    </section>

    <section class="bg-tauf-green-dark py-14 text-center text-white">
        <div class="container-tauf">
            <div class="mx-auto max-w-2xl">
                <h2 class="font-display text-3xl font-extrabold">Envie de nous rejoindre ?</h2>
                <p class="mx-auto mt-4 max-w-2xl text-white/85">Votre énergie et vos compétences sont précieuses pour faire vivre nos programmes.</p>
                <div class="mt-8 flex flex-wrap justify-center gap-3">
                    <a href="{{ route('join') }}" class="btn-gold">Devenir bénévole</a>
                    <a href="{{ route('support') }}" class="btn-outline">Faire un don</a>
                </div>
            </div>
        </div>
    </section>
@endsection
