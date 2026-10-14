@php
    $socials = [
        'facebook_url' => ['icon' => 'facebook', 'label' => 'Facebook'],
        'instagram_url' => ['icon' => 'instagram', 'label' => 'Instagram'],
        'linkedin_url' => ['icon' => 'linkedin', 'label' => 'LinkedIn'],
        'youtube_url' => ['icon' => 'youtube', 'label' => 'YouTube'],
        'twitter_url' => ['icon' => 'twitter', 'label' => 'X (Twitter)'],
        'tiktok_url' => ['icon' => 'tiktok', 'label' => 'TikTok'],
    ];
@endphp

<footer class="mt-20 bg-tauf-green-dark text-white/80">
    <div class="container-tauf grid gap-10 py-14 md:grid-cols-2 lg:grid-cols-4">
        <div>
            <div class="flex items-center gap-3">
                <img src="{{ asset('logo.jpg') }}" alt="{{ $siteName ?? 'ONG TAUF' }}" class="h-16 w-16 rounded-full object-cover ring-2 ring-tauf-gold">
                <div>
                    <p class="font-display text-lg font-extrabold text-white">{{ $siteName ?? 'ONG TAUF' }}</p>
                    <p class="text-xs uppercase tracking-widest text-tauf-gold">Dictée PGL Bénin</p>
                </div>
            </div>
            <p class="mt-5 text-sm leading-relaxed">
                {{ tauf_setting('site_description', "ONG béninoise engagée pour l'éducation, la langue française et la culture, à travers la Dictée PGL Bénin et d'autres programmes éducatifs, culturels et sociaux.") }}
            </p>
            <div class="mt-5 flex flex-wrap gap-2">
                @foreach ($socials as $key => $social)
                    @if (tauf_setting($key))
                        <a href="{{ tauf_setting($key) }}" target="_blank" rel="noopener" aria-label="{{ $social['label'] }}"
                           class="flex h-9 w-9 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-tauf-gold hover:text-tauf-ink">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><use href="#icon-{{ $social['icon'] }}"/></svg>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>

        <div>
            <h3 class="font-display text-base font-bold text-white">Liens rapides</h3>
            <ul class="mt-5 space-y-2.5 text-sm">
                <li><a href="{{ route('about.index') }}" class="transition hover:text-tauf-gold">À propos de nous</a></li>
                <li><a href="{{ route('projects.index') }}" class="transition hover:text-tauf-gold">Réalisations & galerie</a></li>
                <li><a href="{{ route('join') }}" class="transition hover:text-tauf-gold">Nous rejoindre</a></li>
            </ul>
        </div>

        <div>
            <h3 class="font-display text-base font-bold text-white">Nos programmes</h3>
            <ul class="mt-5 space-y-2.5 text-sm">
                @forelse (($footerPrograms ?? collect()) as $fp)
                    <li><a href="{{ route('programs.show', $fp) }}" class="transition hover:text-tauf-gold">{{ $fp->title }}</a></li>
                @empty
                    <li><a href="{{ route('programs.index') }}" class="transition hover:text-tauf-gold">Tous nos programmes</a></li>
                @endforelse
            </ul>
        </div>

        <div>
            <h3 class="font-display text-base font-bold text-white">Restons en contact</h3>
            <ul class="mt-5 space-y-3 text-sm">
                <li class="flex gap-3">
                    <svg class="mt-0.5 h-4 w-4 shrink-0 text-tauf-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 21s-7-5.5-7-11a7 7 0 1114 0c0 5.5-7 11-7 11z"/><circle cx="12" cy="10" r="2.5"/></svg>
                    {{ tauf_setting('contact_address', 'Cotonou, Bénin') }}
                </li>
                <li class="flex gap-3">
                    <svg class="mt-0.5 h-4 w-4 shrink-0 text-tauf-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 16.9v3a2 2 0 01-2.2 2 19.8 19.8 0 01-8.6-3.1 19.5 19.5 0 01-6-6A19.8 19.8 0 012 4.2 2 2 0 014 2h3a2 2 0 012 1.7c.1 1 .4 1.9.7 2.8a2 2 0 01-.5 2.1L8 9.8a16 16 0 006 6l1.2-1.2a2 2 0 012.1-.5c.9.3 1.8.6 2.8.7a2 2 0 011.7 2z"/></svg>
                    {{ tauf_setting('contact_phone', '+229 00 00 00 00') }}
                </li>
                <li class="flex gap-3">
                    <svg class="mt-0.5 h-4 w-4 shrink-0 text-tauf-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16v16H4z"/><path d="M22 6l-10 7L2 6"/></svg>
                    {{ tauf_setting('contact_email', 'contact@ongtauf.org') }}
                </li>
            </ul>

            <form action="{{ route('newsletter.store') }}" method="POST" class="mt-5">
                @csrf
                <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-white/70">Newsletter</label>
                <div class="flex overflow-hidden rounded-full bg-white/10 p-1">
                    <input type="email" name="email" required placeholder="Votre e-mail"
                           class="w-full bg-transparent px-3 text-sm text-white placeholder-white/50 focus:outline-none">
                    <button class="shrink-0 rounded-full bg-tauf-gold px-4 py-2 text-xs font-bold text-tauf-ink transition hover:bg-tauf-gold-dark">OK</button>
                </div>
                @error('email')<p class="mt-1 text-xs text-red-300">{{ $message }}</p>@enderror
            </form>
        </div>
    </div>

    <div class="border-t border-white/10">
        <div class="container-tauf flex flex-col items-center justify-between gap-3 py-5 text-xs sm:flex-row">
            <p>© {{ date('Y') }} {{ $siteName ?? 'ONG TAUF' }}. Tous droits réservés.</p>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('legal') }}" class="transition hover:text-tauf-gold">Mentions légales</a>
                <a href="{{ route('privacy') }}" class="transition hover:text-tauf-gold">Politique de confidentialité</a>
                <a href="{{ route('faq') }}" class="transition hover:text-tauf-gold">FAQ</a>
            </div>
        </div>
    </div>
</footer>
