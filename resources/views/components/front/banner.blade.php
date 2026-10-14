@props(['title', 'subtitle' => null, 'image' => null, 'crumbs' => []])

<section class="relative overflow-hidden bg-tauf-green-dark">
    <div class="absolute inset-0">
        <img src="{{ $image ? upload_url($image) : asset('images/placeholder.svg') }}" alt="" class="h-full w-full object-cover opacity-25">
        <div class="absolute inset-0 bg-gradient-to-r from-tauf-green-dark via-tauf-green-dark/90 to-tauf-green/70"></div>
    </div>
    <div class="container-tauf relative py-14 sm:py-20">
        <nav class="mb-4 flex flex-wrap items-center gap-2 text-xs text-white/70">
            <a href="{{ route('home') }}" class="transition hover:text-tauf-gold">Accueil</a>
            @foreach ($crumbs as $label => $url)
                <span>/</span>
                @if ($url)
                    <a href="{{ $url }}" class="transition hover:text-tauf-gold">{{ $label }}</a>
                @else
                    <span class="text-white">{{ $label }}</span>
                @endif
            @endforeach
        </nav>
        <h1 class="max-w-4xl font-display text-3xl font-extrabold text-white sm:text-4xl lg:text-5xl">{{ $title }}</h1>
        @if ($subtitle)
            <p class="mt-4 max-w-2xl text-base text-white/85">{{ $subtitle }}</p>
        @endif
    </div>
    <div class="absolute -bottom-px left-0 right-0">
        <svg viewBox="0 0 1440 60" fill="none" class="w-full" preserveAspectRatio="none"><path d="M0 60h1440V0c-240 40-480 60-720 60S240 40 0 0v60z" fill="#ffffff"/></svg>
    </div>
</section>
