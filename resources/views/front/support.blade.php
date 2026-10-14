@extends('layouts.front')

@section('title', 'Nous soutenir')

@section('content')
    <x-front.banner
        title="Nous soutenir"
        subtitle="Chaque contribution fait grandir l'éducation et la francophonie au Bénin."
        :crumbs="['Nous soutenir' => null]" />

    <section class="container-tauf py-16">
        <div class="mx-auto max-w-3xl text-center">
            <span class="eyebrow justify-center"><span class="h-px w-8 bg-tauf-gold"></span>Faire un don<span class="h-px w-8 bg-tauf-gold"></span></span>
            <h2 class="section-title">Votre soutien compte</h2>
            <p class="mt-4 text-tauf-gray">
                {{ tauf_setting('donation_info', "Vos dons nous permettent de financer nos programmes éducatifs, culturels et sociaux, d'accompagner les écoles et les jeunes, et d'organiser la Dictée PGL Bénin.") }}
            </p>
        </div>

        @if ($page && $page->body)
            <div class="prose-tauf mx-auto mt-10 max-w-3xl">{!! $page->body !!}</div>
        @endif

        <div class="mx-auto mt-12 grid max-w-4xl gap-6 sm:grid-cols-3">
            @foreach ([
                ['icon' => 'M12 2v20M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6', 'title' => 'Don financier', 'text' => "Soutenez nos actions par un don ponctuel ou régulier."],
                ['icon' => 'M12 21s-7-5.5-7-11a7 7 0 1114 0c0 5.5-7 11-7 11z', 'title' => 'Don en nature', 'text' => "Livres, fournitures, matériel : tout est utile."],
                ['icon' => 'M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zM23 21v-2a4 4 0 00-3-3.9', 'title' => 'Mécénat & partenariat', 'text' => "Entreprises et institutions, engagez-vous à nos côtés."],
            ] as $card)
                <div class="reveal rounded-2xl border border-gray-100 bg-white p-6 text-center shadow-sm">
                    <span class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-tauf-green-light text-tauf-green">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="{{ $card['icon'] }}"/></svg>
                    </span>
                    <h3 class="mt-4 font-display font-bold text-tauf-ink">{{ $card['title'] }}</h3>
                    <p class="mt-2 text-sm text-tauf-gray">{{ $card['text'] }}</p>
                </div>
            @endforeach
        </div>

        <div class="mx-auto mt-12 max-w-3xl rounded-3xl bg-tauf-green-dark p-8 text-center text-white sm:p-12">
            <h2 class="font-display text-2xl font-bold">Prêt(e) à nous soutenir ?</h2>
            <p class="mt-3 text-white/85">Contactez-nous dès maintenant pour connaître les modalités de don ou de partenariat.</p>
            <div class="mt-6 flex flex-wrap justify-center gap-3">
                @if (tauf_setting('donation_url'))
                    <a href="{{ tauf_setting('donation_url') }}" target="_blank" rel="noopener" class="btn-gold">Faire un don en ligne</a>
                @endif
                <a href="{{ route('contact') }}" class="btn-outline">Nous contacter</a>
            </div>
        </div>
    </section>
@endsection
