@php
    $admin = auth()->user();
    $unread = \App\Models\ContactMessage::unread()->count();
    $nav = [
        ['header' => null, 'items' => [
            ['route' => 'admin.dashboard', 'pattern' => 'admin.dashboard', 'label' => 'Tableau de bord', 'icon' => 'M3 12l9-9 9 9M5 10v10h4v-6h6v6h4V10'],
        ]],
        ['header' => 'Contenu', 'items' => [
            ['route' => 'admin.posts.index', 'pattern' => 'admin.posts.*', 'label' => 'Articles', 'icon' => 'M4 19h16M4 5h16v10H4z'],
            ['route' => 'admin.categories.index', 'pattern' => 'admin.categories.*', 'label' => 'Catégories', 'icon' => 'M3 7h18M3 12h18M3 17h18'],
            ['route' => 'admin.programs.index', 'pattern' => 'admin.programs.*', 'label' => 'Programmes', 'icon' => 'M12 2l3 6 6.5.9-4.7 4.6 1.1 6.5L12 17l-5.9 3 1.1-6.5L2.5 8.9 9 8z'],
            ['route' => 'admin.projects.index', 'pattern' => 'admin.projects.*', 'label' => 'Réalisations', 'icon' => 'M3 21h18M5 21V7l7-4 7 4v14'],
            ['route' => 'admin.events.index', 'pattern' => 'admin.events.*', 'label' => 'Événements', 'icon' => 'M3 4h18v18H3zM16 2v4M8 2v4M3 10h18'],

        ]],
        ['header' => 'Médiathèque', 'items' => [
            ['route' => 'admin.albums.index', 'pattern' => 'admin.albums.*', 'label' => 'Albums', 'icon' => 'M3 5h18v14H3zM3 15l5-5 4 4 3-3 6 6'],
            ['route' => 'admin.media.index', 'pattern' => 'admin.media.*', 'label' => 'Médias', 'icon' => 'M4 4h16v16H4zM4 14l4-4 4 4 3-3 5 5'],
        ]],
        ['header' => 'Communication', 'items' => [
            ['route' => 'admin.messages.index', 'pattern' => 'admin.messages.*', 'label' => 'Messages', 'icon' => 'M4 4h16v12H5.2L4 18z', 'badge' => $unread],
            ['route' => 'admin.subscribers.index', 'pattern' => 'admin.subscribers.*', 'label' => 'Abonnés newsletter', 'icon' => 'M22 6l-10 7L2 6M2 4h20v16H2z'],
        ]],
        ['header' => 'Apparence', 'items' => [
            ['route' => 'admin.slides.index', 'pattern' => 'admin.slides.*', 'label' => 'Bannières', 'icon' => 'M3 5h18v10H3zM8 19h8'],
            ['route' => 'admin.partners.index', 'pattern' => 'admin.partners.*', 'label' => 'Partenaires', 'icon' => 'M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zM23 21v-2a4 4 0 00-3-3.9'],
            ['route' => 'admin.testimonials.index', 'pattern' => 'admin.testimonials.*', 'label' => 'Témoignages', 'icon' => 'M7 7h4v4H9c0 2 0 3 2 4v2c-3 0-4-2-4-5V7zm8 0h4v4h-2c0 2 0 3 2 4v2c-3 0-4-2-4-5V7z'],
            ['route' => 'admin.team.index', 'pattern' => 'admin.team.*', 'label' => 'Équipe', 'icon' => 'M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8z'],
            ['route' => 'admin.stats.index', 'pattern' => 'admin.stats.*', 'label' => 'Chiffres clés', 'icon' => 'M3 3v18h18M7 15l3-4 3 3 4-6'],
        ]],
        ['header' => 'Configuration', 'items' => [
            ['route' => 'admin.users.index', 'pattern' => 'admin.users.*', 'label' => 'Utilisateurs', 'icon' => 'M12 12a5 5 0 100-10 5 5 0 000 10zM3 21v-2a6 6 0 016-6h6a6 6 0 016 6v2', 'super' => true],
            ['route' => 'admin.settings.index', 'pattern' => 'admin.settings.*', 'label' => 'Paramètres', 'icon' => 'M12 15a3 3 0 100-6 3 3 0 000 6zM19.4 15a1.6 1.6 0 00.3 1.8l.1.1a2 2 0 11-2.8 2.8l-.1-.1a1.6 1.6 0 00-2.7 1.1V21a2 2 0 11-4 0v-.1A1.6 1.6 0 006 19.4l-.1.1a2 2 0 11-2.8-2.8l.1-.1A1.6 1.6 0 002 13.9H2a2 2 0 110-4h.1A1.6 1.6 0 004.6 6L4.5 6a2 2 0 112.8-2.8l.1.1A1.6 1.6 0 0010 2.1V2a2 2 0 114 0v.1A1.6 1.6 0 0017.4 4.6l.1-.1a2 2 0 112.8 2.8l-.1.1A1.6 1.6 0 0022 10.1h.1a2 2 0 110 4h-.1a1.6 1.6 0 00-1.6.9z'],
        ]],
    ];
@endphp

<aside id="admin-sidebar" class="fixed inset-y-0 left-0 z-50 w-72 -translate-x-full bg-tauf-ink text-white transition-transform duration-300 lg:translate-x-0">
    <div class="flex h-16 items-center gap-3 border-b border-white/10 px-5">
        <img src="{{ asset('logo.jpg') }}" alt="" class="h-10 w-10 rounded-full object-cover ring-2 ring-tauf-gold">
        <div class="leading-tight">
            <p class="font-display text-sm font-extrabold">ONG TAUF</p>
            <p class="text-[10px] uppercase tracking-wider text-tauf-gold">Espace administration</p>
        </div>
        <button data-sidebar-toggle class="ml-auto rounded-lg p-1.5 text-white/60 hover:bg-white/10 lg:hidden">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>

    <nav class="h-[calc(100vh-4rem)] space-y-4 overflow-y-auto px-3 py-4">
        @foreach ($nav as $section)
            @if ($section['header'])
                <p class="px-3 pt-2 text-[10px] font-bold uppercase tracking-widest text-white/40">{{ $section['header'] }}</p>
            @endif
            <div class="space-y-0.5">
                @foreach ($section['items'] as $item)
                    @continue(($item['super'] ?? false) && (! $admin?->canManageUsers()))
                    @php $active = request()->routeIs($item['pattern']); @endphp
                    <a href="{{ route($item['route']) }}"
                       class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition {{ $active ? 'bg-tauf-green text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                        <svg class="h-[18px] w-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="{{ $item['icon'] }}"/></svg>
                        <span class="flex-1">{{ $item['label'] }}</span>
                        @if (! empty($item['badge']))
                            <span class="rounded-full bg-tauf-red px-2 py-0.5 text-[10px] font-bold text-white">{{ $item['badge'] }}</span>
                        @endif
                    </a>
                @endforeach
            </div>
        @endforeach

        <div class="border-t border-white/10 pt-4">
            <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-white/70 hover:bg-white/10 hover:text-white">
                <svg class="h-[18px] w-[18px]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg>
                Voir le site
            </a>
        </div>
    </nav>
</aside>
<div data-sidebar-overlay class="fixed inset-0 z-40 hidden bg-black/50 lg:hidden"></div>
