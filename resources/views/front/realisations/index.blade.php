@extends('layouts.front')

@section('title', 'Réalisations & galerie')

@section('content')
    <x-front.banner
        title="Réalisations & galerie"
        subtitle="Découvrez les projets menés par l'ONG TAUF, leur impact, ainsi que nos photos, vidéos et documents."
        :crumbs="['Réalisations & galerie' => null]" />

    <section class="container-tauf py-16">
        <h2 class="section-title mb-8">Nos réalisations</h2>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($projects as $project)
                <a href="{{ route('projects.show', $project) }}" class="card reveal group overflow-hidden">
                    <div class="card-media">
                        <img src="{{ upload_url($project->cover) }}" alt="{{ $project->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                    </div>
                    <div class="p-6">
                        @if ($project->location)
                            <span class="inline-flex items-center gap-1 text-xs font-semibold uppercase tracking-wider text-tauf-gold-dark">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 21s-7-5.5-7-11a7 7 0 1114 0c0 5.5-7 11-7 11z"/><circle cx="12" cy="10" r="2.5"/></svg>
                                {{ $project->location }}
                            </span>
                        @endif
                        <h3 class="mt-1 font-display text-lg font-bold text-tauf-ink group-hover:text-tauf-green">{{ $project->title }}</h3>
                        <p class="mt-2 line-clamp-3 text-sm text-tauf-gray">{{ $project->excerpt }}</p>
                    </div>
                </a>
            @empty
                <p class="col-span-full rounded-2xl bg-tauf-cream p-8 text-center text-tauf-gray">Aucune réalisation publiée pour le moment.</p>
            @endforelse
        </div>
        <div class="mt-10">{{ $projects->links() }}</div>
    </section>

    <section class="bg-tauf-cream py-16">
        <div class="container-tauf">
            <h2 class="section-title mb-8">Galerie photos</h2>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($albums as $album)
                    <a href="{{ route('media.album', $album) }}" class="card reveal group overflow-hidden">
                        <div class="card-media relative">
                            <img src="{{ upload_url($album->cover) }}" alt="{{ $album->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                            <span class="absolute bottom-3 right-3 rounded-full bg-black/60 px-3 py-1 text-xs font-semibold text-white">{{ $album->images_count }} photos</span>
                        </div>
                        <div class="p-5">
                            <h3 class="font-display font-bold text-tauf-ink group-hover:text-tauf-green">{{ $album->name }}</h3>
                            @if ($album->description)<p class="mt-1 line-clamp-2 text-sm text-tauf-gray">{{ $album->description }}</p>@endif
                        </div>
                    </a>
                @empty
                    <p class="col-span-full rounded-2xl bg-white p-8 text-center text-tauf-gray">Aucun album pour le moment.</p>
                @endforelse
            </div>

            @if ($videos->isNotEmpty())
                <h2 class="section-title mb-8 mt-16">Vidéos</h2>
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($videos as $video)
                        <button type="button" data-video-modal="{{ $video->url ?: upload_url($video->file_path) }}" data-video-title="{{ $video->title }}" class="card group cursor-pointer overflow-hidden text-left">
                            <div class="card-media relative bg-tauf-ink">
                                <img src="{{ upload_url($video->cover ?? null) }}" alt="{{ $video->title }}" class="h-full w-full object-cover opacity-60">
                                <span class="absolute inset-0 flex items-center justify-center">
                                    <span class="flex h-14 w-14 items-center justify-center rounded-full bg-tauf-red text-white shadow-lg transition group-hover:scale-110"><svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg></span>
                                </span>
                            </div>
                            <div class="p-5"><h3 class="font-display font-bold text-tauf-ink">{{ $video->title }}</h3></div>
                        </button>
                    @endforeach
                </div>
            @endif

            @if ($documents->isNotEmpty())
                <h2 class="section-title mb-8 mt-16">Documents à télécharger</h2>
                <div class="space-y-3">
                    @foreach ($documents as $doc)
                        <a href="{{ upload_url($doc->file_path) }}" target="_blank" class="card flex items-center gap-4 p-4">
                            <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-tauf-red/10 text-tauf-red">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><path d="M14 2v6h6"/></svg>
                            </span>
                            <span class="flex-1 font-medium text-tauf-ink">{{ $doc->title }}</span>
                            <span class="text-sm font-semibold text-tauf-green">Télécharger</span>
                        </a>
                    @endforeach
                </div>
            @endif

            @if ($albums->isEmpty() && $videos->isEmpty() && $documents->isEmpty())
                <p class="rounded-2xl bg-white p-8 text-center text-tauf-gray">La galerie sera bientôt enrichie.</p>
            @endif
        </div>
    </section>

    <div data-video-modal-overlay class="fixed inset-0 z-[80] hidden items-center justify-center bg-tauf-ink/90 p-4 backdrop-blur-sm">
        <div class="relative w-full max-w-4xl">
            <button type="button" data-video-modal-close class="absolute -top-10 right-0 flex h-8 w-8 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-white/20" aria-label="Fermer la vidéo">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"/></svg>
            </button>
            <div data-video-frame class="overflow-hidden rounded-2xl bg-black shadow-2xl"></div>
            <p data-video-title class="mt-3 text-center font-display text-sm font-bold text-white/90"></p>
        </div>
    </div>
@endsection
