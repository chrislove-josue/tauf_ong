@extends('layouts.front')

@section('title', $album->name)

@section('content')
    <x-front.banner
        :title="$album->name"
        :subtitle="$album->description"
        :image="$album->cover"
        :crumbs="['Réalisations & galerie' => route('projects.index'), $album->name => null]" />

    <section class="container-tauf py-16">
        <div class="mb-6 flex flex-wrap items-center justify-between gap-4 text-sm text-tauf-gray">
            <x-front.views :count="$album->views" />
            <x-front.share :title="$album->name" />
        </div>
        @if ($album->images->isEmpty())
            <p class="rounded-2xl bg-tauf-cream p-8 text-center text-tauf-gray">Aucune photo dans cet album.</p>
        @else
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
                @foreach ($album->images as $image)
                    <a href="{{ upload_url($image->file_path) }}" target="_blank" class="group overflow-hidden rounded-2xl">
                        <img src="{{ upload_url($image->file_path) }}" alt="{{ $image->alt ?: $image->title }}" class="h-44 w-full object-cover transition duration-500 group-hover:scale-105">
                    </a>
                @endforeach
            </div>
        @endif

        @if ($others->isNotEmpty())
            <h2 class="section-title mb-6 mt-16 !text-2xl">Autres albums</h2>
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6">
                @foreach ($others as $other)
                    <a href="{{ route('media.album', $other) }}" class="group overflow-hidden rounded-2xl">
                        <img src="{{ upload_url($other->cover) }}" alt="{{ $other->name }}" class="h-24 w-full object-cover transition group-hover:scale-105">
                    </a>
                @endforeach
            </div>
        @endif
    </section>
@endsection
