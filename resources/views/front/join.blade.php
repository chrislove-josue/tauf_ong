@extends('layouts.front')

@section('title', 'Nous rejoindre')

@section('content')
    <x-front.banner
        title="Nous rejoindre"
        subtitle="Bénévolat, adhésion, stages et recrutement : engagez-vous à nos côtés."
        :crumbs="['Nous rejoindre' => null]" />

    <section class="container-tauf py-16">
        <div class="mx-auto max-w-3xl">
            @if ($page && $page->body)
                <div class="prose-tauf">{!! $page->body !!}</div>
            @else
                <p class="text-tauf-gray">
                    {{ tauf_setting('join_info', "Rejoignez l'ONG TAUF en tant que bénévole, adhérent, stagiaire ou collaborateur. Votre énergie et vos compétences sont précieuses pour faire vivre nos programmes.") }}
                </p>
            @endif
        </div>

        <div class="mx-auto mt-12 grid max-w-4xl gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ([
                ['title' => 'Devenir bénévole', 'text' => "Donnez de votre temps pour nos événements et programmes."],
                ['title' => 'Adhérer', 'text' => "Rejoignez l'association et participez à la vie de l'ONG."],
                ['title' => 'Faire un stage', 'text' => "Étudiant(e) ? Vivez une expérience de terrain enrichissante."],
                ['title' => 'Recrutement', 'text' => "Consultez nos opportunités d'emploi et candidatures."],
            ] as $card)
                <div class="reveal rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
                    <h3 class="font-display font-bold text-tauf-ink">{{ $card['title'] }}</h3>
                    <p class="mt-2 text-sm text-tauf-gray">{{ $card['text'] }}</p>
                </div>
            @endforeach
        </div>

        <div class="mx-auto mt-12 max-w-3xl rounded-3xl bg-tauf-green p-8 text-center text-white sm:p-12">
            <h2 class="font-display text-2xl font-bold">Envie de nous rejoindre ?</h2>
            <p class="mt-3 text-white/85">
                Envoyez-nous votre candidature à
                <a href="mailto:{{ tauf_setting('join_email', tauf_setting('contact_email', 'contact@ongtauf.org')) }}" class="font-semibold underline">
                    {{ tauf_setting('join_email', tauf_setting('contact_email', 'contact@ongtauf.org')) }}
                </a>
                ou via le formulaire de contact.
            </p>
            <a href="{{ route('contact') }}" class="btn-gold mt-6">Nous écrire</a>
        </div>
    </section>
@endsection
