<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $siteName ?? 'ONG TAUF')@hasSection('title') · {{ $siteName ?? 'ONG TAUF' }}@endif</title>
    <meta name="description" content="@yield('meta_description', tauf_setting('site_description', 'ONG TAUF — promotion de l\'éducation, de la langue française et de la culture au Bénin.'))">
    <meta name="keywords" content="@yield('meta_keywords', tauf_setting('seo_keywords', 'ONG TAUF, Dictée PGL Bénin, éducation, francophonie, Bénin'))">
    <link rel="icon" href="{{ asset('logo.jpg') }}" type="image/jpeg">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $siteName ?? 'ONG TAUF' }}">
    <meta property="og:title" content="@yield('title', $siteName ?? 'ONG TAUF')">
    <meta property="og:description" content="@yield('meta_description', tauf_setting('site_description'))">
    <meta property="og:image" content="@yield('og_image', asset('logo.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">

    @if (tauf_setting('google_analytics'))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ tauf_setting('google_analytics') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ tauf_setting('google_analytics') }}');
        </script>
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="flex min-h-screen flex-col">
    @include('partials.front.icons')

    <a href="#contenu" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-[100] focus:rounded-full focus:bg-tauf-green focus:px-4 focus:py-2 focus:text-white">Aller au contenu</a>

    @include('partials.front.header')

    <main id="contenu" class="flex-1">
        @if (session('success') || session('newsletter_success'))
            <div class="container-tauf pt-6">
                <div class="rounded-2xl border border-tauf-green/30 bg-tauf-green-light px-5 py-4 text-sm font-medium text-tauf-green-dark">
                    {{ session('success') ?? session('newsletter_success') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    @include('partials.front.footer')

    <button data-back-to-top class="fixed bottom-6 right-6 z-40 flex h-11 w-11 items-center justify-center rounded-full bg-tauf-green text-white shadow-lg opacity-0 transition pointer-events-none hover:bg-tauf-green-dark" aria-label="Haut de page">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
    </button>

    <div data-cookie-banner class="fixed inset-x-0 bottom-0 z-[60] hidden p-4">
        <div class="container-tauf">
            <div class="flex flex-col items-start gap-4 rounded-2xl bg-tauf-ink px-5 py-4 text-sm text-white shadow-2xl sm:flex-row sm:items-center sm:justify-between">
                <p class="flex-1">
                    {{ tauf_setting('cookie_notice', 'Ce site utilise des cookies pour améliorer votre expérience de navigation. En continuant, vous acceptez notre politique de confidentialité.') }}
                    <a href="{{ route('privacy') }}" class="font-semibold text-tauf-gold underline">En savoir plus</a>
                </p>
                <button data-cookie-accept class="btn-gold !py-2 text-xs">Accepter</button>
            </div>
        </div>
    </div>
</body>
</html>
