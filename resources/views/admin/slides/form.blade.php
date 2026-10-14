@extends('layouts.admin')

@section('title', $slide->exists ? 'Modifier la bannière' : 'Nouvelle bannière')
@section('heading', $slide->exists ? 'Modifier la bannière' : 'Nouvelle bannière')

@section('content')
    <div class="mx-auto max-w-2xl">
        <form action="{{ $slide->exists ? route('admin.slides.update', $slide) : route('admin.slides.store') }}" method="POST" enctype="multipart/form-data" class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
            @csrf
            @if ($slide->exists) @method('PUT') @endif
            <div class="space-y-5">
                <x-admin.input name="title" label="Titre" :value="$slide->title" required />
                <x-admin.input name="subtitle" label="Sous-titre" :value="$slide->subtitle" />
                <x-admin.textarea name="text" label="Texte" :value="$slide->text" :rows="3" />
                <div class="grid gap-4 sm:grid-cols-2">
                    <x-admin.input name="button_text" label="Texte du bouton" :value="$slide->button_text" />
                    <x-admin.input name="button_url" label="Lien du bouton" :value="$slide->button_url" />
                </div>
                <x-admin.input name="order" label="Ordre" type="number" :value="$slide->order ?? 0" />
                <x-admin.image name="image" label="Image de fond" :value="$slide->image" help="Format recommandé : 1920×900 px." />
                <x-admin.checkbox name="is_active" label="Active" :checked="$slide->is_active" />
            </div>
            <div class="mt-6 flex gap-3">
                <button class="btn-primary">Enregistrer</button>
                <a href="{{ route('admin.slides.index') }}" class="btn-outline-dark">Annuler</a>
            </div>
        </form>
    </div>
@endsection
