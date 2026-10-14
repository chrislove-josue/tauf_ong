@extends('layouts.front')

@section('title', 'Notre histoire')

@section('content')
    <x-front.banner
        title="Notre histoire"
        subtitle="Qui sommes-nous et d'où venons-nous."
        :crumbs="['À propos' => route('about.index'), 'Notre histoire' => null]" />

    <section class="container-tauf py-16">
        <div class="mx-auto max-w-3xl">
            <div class="prose-tauf">
                @if ($page && $page->body)
                    {!! $page->body !!}
                @else
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
@endsection
