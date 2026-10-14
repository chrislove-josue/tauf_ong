@extends('layouts.front')

@section('title', "À propos de l'ONG TAUF")

@section('content')
    <x-front.banner
        title="À propos de l'ONG TAUF"
        subtitle="Une organisation béninoise au service de l'éducation, de la langue française et de la culture."
        :crumbs="['À propos' => null]" />

    <section class="container-tauf py-16">
        <div class="grid gap-12 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <div class="prose-tauf">
                    @if ($page && $page->body)
                        {!! $page->body !!}
                    @else
                        <p>L'ONG TAUF est une organisation non gouvernementale béninoise engagée dans la promotion de l'éducation, de la langue française et de la culture, notamment à travers l'organisation de la « Dictée PGL Bénin » et d'autres programmes à vocation éducative, culturelle et sociale.</p>
                        <p>À travers ses actions de terrain, ses partenariats et ses réalisations, l'ONG TAUF œuvre pour l'épanouissement des jeunes et le rayonnement de la francophonie au Bénin.</p>
                    @endif
                </div>

                <div class="mt-10 grid gap-5 sm:grid-cols-3">
                    <a href="{{ route('about.history') }}" class="card p-5 hover:border-tauf-green">
                        <h3 class="font-display font-bold text-tauf-ink">Notre histoire</h3>
                        <p class="mt-1 text-sm text-tauf-gray">Découvrez notre parcours et nos origines.</p>
                    </a>
                    <a href="{{ route('about.mission') }}" class="card p-5 hover:border-tauf-green">
                        <h3 class="font-display font-bold text-tauf-ink">Mission & valeurs</h3>
                        <p class="mt-1 text-sm text-tauf-gray">Ce qui nous guide au quotidien.</p>
                    </a>
                    <a href="{{ route('about.organisation') }}" class="card p-5 hover:border-tauf-green">
                        <h3 class="font-display font-bold text-tauf-ink">Gouvernance</h3>
                        <p class="mt-1 text-sm text-tauf-gray">Notre organisation et notre équipe.</p>
                    </a>
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
@endsection
