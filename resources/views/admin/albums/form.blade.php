@extends('layouts.admin')

@section('title', $album->exists ? 'Modifier l\'album' : 'Nouvel album')
@section('heading', $album->exists ? 'Modifier l\'album' : 'Nouvel album')

@section('content')
    <div class="mx-auto max-w-2xl">
        <form action="{{ $album->exists ? route('admin.albums.update', $album) : route('admin.albums.store') }}" method="POST" enctype="multipart/form-data" class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
            @csrf
            @if ($album->exists) @method('PUT') @endif
            <div class="space-y-5">
                <x-admin.input name="name" label="Nom de l'album" :value="$album->name" required />
                <x-admin.input name="slug" label="Slug" :value="$album->slug" />
                <x-admin.textarea name="description" label="Description" :value="$album->description" :rows="3" />
                <x-admin.input name="order" label="Ordre" type="number" :value="$album->order ?? 0" />
                <x-admin.image name="cover" label="Image de couverture" :value="$album->cover" />
            </div>
            <div class="mt-6 flex gap-3">
                <button class="btn-primary">Enregistrer</button>
                <a href="{{ route('admin.albums.index') }}" class="btn-outline-dark">Annuler</a>
            </div>
        </form>
    </div>
@endsection
