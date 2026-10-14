@php
    $is = fn (string ...$names) => request()->routeIs(...$names);
@endphp

{{-- Barre supérieure --}}
<div class="hidden bg-tauf-green-dark text-white lg:block">
    <div class="container-tauf flex h-10 items-center justify-between text-xs">
        <div class="flex items-center gap-5">
            <span class="inline-flex items-center gap-1.5">
                <svg class="h-3.5 w-3.5 text-tauf-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 21s-7-5.5-7-11a7 7 0 1114 0c0 5.5-7 11-7 11z"/><circle cx="12" cy="10" r="2.5"/></svg>
                {{ tauf_setting('contact_address', 'Cotonou, Bénin') }}
            </span>
            <span class="inline-flex items-center gap-1.5">
                <svg class="h-3.5 w-3.5 text-tauf-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 16.9v3a2 2 0 01-2.2 2 19.8 19.8 0 01-8.6-3.1 19.5 19.5 0 01-6-6A19.8 19.8 0 012 4.2 2 2 0 014 2h3a2 2 0 012 1.7c.1 1 .4 1.9.7 2.8a2 2 0 01-.5 2.1L8 9.8a16 16 0 006 6l1.2-1.2a2 2 0 012.1-.5c.9.3 1.8.6 2.8.7a2 2 0 011.7 2z"/></svg>
                {{ tauf_setting('contact_phone', '+229 00 00 00 00') }}
            </span>
            <span class="inline-flex items-center gap-1.5">
                <svg class="h-3.5 w-3.5 text-tauf-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16v16H4z"/><path d="M22 6l-10 7L2 6"/></svg>
                {{ tauf_setting('contact_email', 'contact@ongtauf.org') }}
            </span>
        </div>
        <div class="flex items-center gap-3">
            @foreach (['facebook_url' => 'facebook', 'instagram_url' => 'instagram', 'linkedin_url' => 'linkedin', 'youtube_url' => 'youtube'] as $key => $name)
                @if (tauf_setting($key))
                    <a href="{{ tauf_setting($key) }}" target="_blank" rel="noopener" class="text-white/80 transition hover:text-tauf-gold" aria-label="{{ $name }}">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><use href="#icon-{{ $name }}"/></svg>
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</div>

{{-- Navigation principale --}}
<header data-header class="sticky top-0 z-50 w-full border-b border-gray-100 bg-white/95 backdrop-blur transition-shadow [&.is-scrolled]:shadow-md">
    <div class="container-tauf flex h-20 items-center justify-between gap-4">
        <a href="{{ route('home') }}" class="flex shrink-0 items-center gap-3">
            <img src="{{ asset('logo.jpg') }}" alt="{{ $siteName ?? 'ONG TAUF' }}" class="h-14 w-14 rounded-full object-cover ring-2 ring-tauf-gold">
            <span class="hidden leading-tight sm:block">
                <span class="block font-display text-lg font-extrabold text-tauf-green">{{ $siteName ?? 'ONG TAUF' }}</span>
                <span class="block text-[11px] font-semibold uppercase tracking-widest text-tauf-gold-dark">Dictée PGL Bénin</span>
            </span>
        </a>

        <nav class="hidden items-center gap-1 xl:flex">
            <a href="{{ route('home') }}" class="rounded-full px-3 py-2 text-sm font-semibold {{ $is('home') ? 'text-tauf-green' : 'text-tauf-ink hover:text-tauf-green' }}">Accueil</a>

            <div class="relative" data-dropdown>
                <button data-dropdown-trigger class="flex items-center gap-1 rounded-full px-3 py-2 text-sm font-semibold {{ $is('about.*') ? 'text-tauf-green' : 'text-tauf-ink hover:text-tauf-green' }}">
                    À propos
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </button>
                <div data-dropdown-menu class="absolute left-0 top-full z-50 hidden w-64 overflow-hidden rounded-2xl border border-gray-100 bg-white py-2 shadow-xl">
                    <a href="{{ route('about.index') }}#presentation" class="block px-4 py-2.5 text-sm hover:bg-tauf-green-light hover:text-tauf-green">Présentation de l'ONG</a>
                    <a href="{{ route('about.index') }}#histoire" class="block px-4 py-2.5 text-sm hover:bg-tauf-green-light hover:text-tauf-green">Notre histoire</a>
                    <a href="{{ route('about.index') }}#mission" class="block px-4 py-2.5 text-sm hover:bg-tauf-green-light hover:text-tauf-green">Mission, vision, valeurs</a>
                    <a href="{{ route('about.index') }}#organisation" class="block px-4 py-2.5 text-sm hover:bg-tauf-green-light hover:text-tauf-green">Organisation & gouvernance</a>
                </div>
            </div>

            <div class="relative" data-dropdown>
                <button data-dropdown-trigger class="flex items-center gap-1 rounded-full px-3 py-2 text-sm font-semibold {{ $is('programs.*') ? 'text-tauf-green' : 'text-tauf-ink hover:text-tauf-green' }}">
                    Programmes
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </button>
                <div data-dropdown-menu class="absolute left-0 top-full z-50 hidden w-72 overflow-hidden rounded-2xl border border-gray-100 bg-white py-2 shadow-xl">
                    <a href="{{ route('programs.index') }}" class="block px-4 py-2.5 text-sm font-semibold text-tauf-green hover:bg-tauf-green-light">Tous les programmes</a>
                    <div class="my-1 border-t border-gray-100"></div>
                    @forelse (($navPrograms ?? collect()) as $np)
                        <a href="{{ route('programs.show', $np) }}" class="block px-4 py-2.5 text-sm hover:bg-tauf-green-light hover:text-tauf-green">{{ $np->title }}</a>
                    @empty
                        <span class="block px-4 py-2.5 text-sm text-gray-400">Aucun programme</span>
                    @endforelse
                </div>
            </div>

            <a href="{{ route("projects.index") }}" class="block rounded-lg px-4 py-3 font-semibold hover:bg-tauf-green-light">Réalisations</a>
            <a href="{{ route("posts.index") }}" class="block rounded-lg px-4 py-3 font-semibold hover:bg-tauf-green-light">Actualités</a>
            <a href="{{ route('contact') }}" class="rounded-full px-3 py-2 text-sm font-semibold {{ $is('contact') ? 'text-tauf-green' : 'text-tauf-ink hover:text-tauf-green' }}">Contact</a>
        </nav>

        <div class="hidden items-center gap-3 xl:flex">
            <a href="{{ route('support') }}" class="btn-gold !px-5 !py-2.5 text-xs">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20.8 4.6a5.5 5.5 0 00-7.8 0L12 5.6l-1-1a5.5 5.5 0 10-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 000-7.8z"/></svg>
                Faire un don
            </a>
        </div>

        <button data-mobile-toggle="#mobile-menu" class="rounded-lg p-2 text-tauf-ink xl:hidden" aria-label="Menu">
            <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
    </div>

    {{-- Menu mobile --}}
    <div id="mobile-menu" class="hidden border-t border-gray-100 bg-white xl:hidden">
        <div class="container-tauf max-h-[80vh] space-y-1 overflow-y-auto py-4">
            <a href="{{ route('home') }}" class="block rounded-lg px-4 py-3 font-semibold hover:bg-tauf-green-light">Accueil</a>
            <div class="border-t border-gray-100 pt-1"></div>
            <p class="px-4 pt-2 text-xs font-bold uppercase tracking-wider text-gray-400">À propos</p>
            <a href="{{ route('about.index') }}#presentation" class="block rounded-lg px-4 py-2.5 hover:bg-tauf-green-light">Présentation</a>
            <a href="{{ route('about.index') }}#histoire" class="block rounded-lg px-4 py-2.5 hover:bg-tauf-green-light">Notre histoire</a>
            <a href="{{ route('about.index') }}#mission" class="block rounded-lg px-4 py-2.5 hover:bg-tauf-green-light">Mission, vision, valeurs</a>
            <a href="{{ route('about.index') }}#organisation" class="block rounded-lg px-4 py-2.5 hover:bg-tauf-green-light">Organisation & gouvernance</a>
            <div class="border-t border-gray-100 pt-1"></div>
            <a href="{{ route('programs.index') }}" class="block rounded-lg px-4 py-3 font-semibold hover:bg-tauf-green-light">Programmes</a>
            <a href="{{ route('projects.index') }}" class="block rounded-lg px-4 py-3 font-semibold hover:bg-tauf-green-light">Réalisations</a>
            <a href="{{ route('posts.index') }}" class="block rounded-lg px-4 py-3 font-semibold hover:bg-tauf-green-light">Actualités</a>
            <a href="{{ route('join') }}" class="block rounded-lg px-4 py-3 font-semibold hover:bg-tauf-green-light">Nous rejoindre</a>
            <a href="{{ route('contact') }}" class="block rounded-lg px-4 py-3 font-semibold hover:bg-tauf-green-light">Contact</a>
            <a href="{{ route('support') }}" class="btn-gold mt-2 w-full">Faire un don</a>
        </div>
    </div>
</header>
