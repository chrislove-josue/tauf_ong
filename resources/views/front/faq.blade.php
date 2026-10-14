@extends('layouts.front')

@section('title', 'Questions fréquentes')

@section('content')
    <x-front.banner
        title="Questions fréquentes"
        subtitle="Vous avez des questions ? Nous avons les réponses."
        :crumbs="['FAQ' => null]" />

    <section class="container-tauf py-16">
        <div class="mx-auto max-w-3xl">
            @if ($page && $page->body)
                <div class="prose-tauf">{!! $page->body !!}</div>
            @endif

            <div class="mt-8 space-y-3">
                @php
                    $faqs = [
                        ["Qu'est-ce que l'ONG TAUF ?", "L'ONG TAUF est une organisation non gouvernementale béninoise engagée dans la promotion de l'éducation, de la langue française et de la culture."],
                        ["Qu'est-ce que la Dictée PGL Bénin ?", "La Dictée PGL Bénin est un programme phare de l'ONG TAUF : une grande dictée qui rassemble les élèves et promeut la maîtrise de la langue française."],
                        ["Comment participer à un événement ?", "Consultez notre agenda, puis contactez-nous via le formulaire de contact pour vous inscrire à un événement."],
                        ["Comment soutenir l'ONG ?", "Vous pouvez faire un don, devenir bénévole, adhérer ou nouer un partenariat. Rendez-vous sur la page « Nous soutenir »."],
                        ["Comment vous contacter ?", "Via le formulaire de contact, par e-mail ou par téléphone. Toutes nos coordonnées sont sur la page Contact."],
                    ];
                @endphp

                @foreach ($faqs as $faq)
                    <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">
                        <button data-accordion-trigger class="flex w-full items-center justify-between gap-4 px-6 py-4 text-left">
                            <span class="font-display font-bold text-tauf-ink">{{ $faq[0] }}</span>
                            <svg data-accordion-icon class="h-5 w-5 shrink-0 text-tauf-green transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                        </button>
                        <div class="accordion-body">
                            <p class="px-6 pb-5 text-sm text-tauf-gray">{{ $faq[1] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 rounded-3xl bg-tauf-cream p-8 text-center">
                <h2 class="font-display text-xl font-bold text-tauf-ink">Vous ne trouvez pas votre réponse ?</h2>
                <p class="mt-2 text-sm text-tauf-gray">Notre équipe est à votre écoute.</p>
                <a href="{{ route('contact') }}" class="btn-primary mt-5">Nous contacter</a>
            </div>
        </div>
    </section>
@endsection
