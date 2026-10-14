<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Administration') · ONG TAUF</title>
    <link rel="icon" href="{{ asset('logo.jpg') }}" type="image/jpeg">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="bg-gray-50 text-tauf-ink">
    @include('partials.admin.sidebar')

    <div class="lg:pl-72">
        {{-- Topbar --}}
        <header class="sticky top-0 z-30 flex h-16 items-center gap-4 border-b border-gray-200 bg-white/95 px-4 backdrop-blur sm:px-6">
            <button data-sidebar-toggle class="rounded-lg p-2 text-tauf-ink hover:bg-gray-100 lg:hidden">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>

            <div class="min-w-0 flex-1">
                <h1 class="truncate font-display text-lg font-bold text-tauf-ink">@yield('heading', 'Tableau de bord')</h1>
                @hasSection('subheading')
                    <p class="truncate text-xs text-tauf-gray">@yield('subheading')</p>
                @endif
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('home') }}" target="_blank" class="hidden rounded-full border border-gray-200 px-4 py-2 text-xs font-semibold text-tauf-gray transition hover:border-tauf-green hover:text-tauf-green sm:inline-flex">Voir le site</a>

                <div class="relative" data-dropdown>
                    <button data-dropdown-trigger class="flex items-center gap-2 rounded-full border border-gray-200 py-1 pl-1 pr-3 text-sm hover:border-tauf-green">
                        <img src="{{ upload_url(auth()->user()->photo, 'images/placeholder.svg') }}" alt="" class="h-8 w-8 rounded-full object-cover">
                        <span class="hidden font-semibold sm:block">{{ auth()->user()->name }}</span>
                        <svg class="h-4 w-4 text-tauf-gray" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                    </button>
                    <div data-dropdown-menu class="absolute right-0 top-full z-50 hidden w-56 overflow-hidden rounded-2xl border border-gray-100 bg-white py-2 shadow-xl">
                        <div class="border-b border-gray-100 px-4 pb-2 pt-1">
                            <p class="text-sm font-semibold">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-tauf-gray">{{ auth()->user()->roleLabel() }}</p>
                        </div>
                        <a href="{{ route('admin.profile.edit') }}" class="block px-4 py-2.5 text-sm hover:bg-tauf-green-light">Mon profil</a>
                        <a href="{{ route('admin.settings.index') }}" class="block px-4 py-2.5 text-sm hover:bg-tauf-green-light">Paramètres</a>
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="block w-full px-4 py-2.5 text-left text-sm text-tauf-red hover:bg-red-50">Se déconnecter</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <main class="p-4 sm:p-6">
            @if (session('success'))
                <div class="mb-5 flex items-center gap-3 rounded-2xl border border-tauf-green/30 bg-tauf-green-light px-4 py-3 text-sm font-medium text-tauf-green-dark">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    <p class="font-semibold">Veuillez corriger les erreurs suivantes :</p>
                    <ul class="mt-1 list-disc pl-5">
                        @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
