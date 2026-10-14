@extends('layouts.admin')

@section('title', $medium->exists ? 'Modifier le média' : 'Téléverser des médias')
@section('heading', $medium->exists ? 'Modifier le média' : 'Téléverser des médias')

@section('content')
    <div class="mx-auto max-w-2xl">
        @if ($medium->exists)
            <form action="{{ route('admin.media.update', $medium) }}" method="POST" class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
                @csrf @method('PUT')
                <div class="mb-5">
                    @if ($medium->type === 'image')
                        <img src="{{ upload_url($medium->file_path) }}" class="h-40 w-full rounded-xl object-cover">
                    @endif
                </div>
                <div class="space-y-5">
                    <x-admin.input name="title" label="Titre" :value="$medium->title" />
                    <x-admin.input name="alt" label="Texte alternatif (accessibilité)" :value="$medium->alt" />
                    <x-admin.select name="album_id" label="Album" :value="$medium->album_id" :options="$albums->pluck('name', 'id')->toArray()" placeholder="— Aucun —" />
                    <x-admin.select name="type" label="Type" :value="$medium->type" :options="['image' => 'Image', 'video' => 'Vidéo', 'document' => 'Document']" required />
                    <x-admin.input name="url" label="URL externe (vidéo)" :value="$medium->url" help="Pour une vidéo hébergée (YouTube, etc.)." />
                    <x-admin.input name="order" label="Ordre" type="number" :value="$medium->order ?? 0" />
                </div>
                <div class="mt-6 flex gap-3">
                    <button class="btn-primary">Enregistrer</button>
                    <a href="{{ route('admin.media.index') }}" class="btn-outline-dark">Annuler</a>
                </div>
            </form>
        @else
            <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
                @csrf
                <div class="space-y-5">
                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-tauf-ink">Fichiers <span class="text-tauf-red">*</span></label>
                        <input type="file" name="files[]" multiple required class="w-full rounded-xl border border-gray-200 px-3 py-2 text-sm file:mr-3 file:rounded-full file:border-0 file:bg-tauf-green-light file:px-4 file:py-1.5 file:text-tauf-green">
                        <p class="mt-1 text-xs text-tauf-gray">Sélectionnez un ou plusieurs fichiers (images, vidéos, PDF).</p>
                    </div>
                    <x-admin.select name="album_id" label="Album" :options="$albums->pluck('name', 'id')->toArray()" placeholder="— Aucun —" />
                    <x-admin.select name="type" label="Type" :value="'image'" :options="['image' => 'Image', 'video' => 'Vidéo', 'document' => 'Document']" required />
                </div>
                <div class="mt-6 flex gap-3">
                    <button class="btn-primary">Téléverser</button>
                    <a href="{{ route('admin.media.index') }}" class="btn-outline-dark">Annuler</a>
                </div>
            </form>
        @endif
    </div>
@endsection
