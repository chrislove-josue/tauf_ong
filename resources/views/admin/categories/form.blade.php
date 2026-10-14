@extends('layouts.admin')

@section('title', $category->exists ? 'Modifier la catégorie' : 'Nouvelle catégorie')
@section('heading', $category->exists ? 'Modifier la catégorie' : 'Nouvelle catégorie')

@section('content')
    <div class="mx-auto max-w-2xl">
        <form action="{{ $category->exists ? route('admin.categories.update', $category) : route('admin.categories.store') }}" method="POST" class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
            @csrf
            @if ($category->exists) @method('PUT') @endif
            <div class="space-y-5">
                <x-admin.input name="name" label="Nom" :value="$category->name" required />
                <x-admin.input name="slug" label="Slug" :value="$category->slug" help="Laissez vide pour générer automatiquement." />
                <x-admin.textarea name="description" label="Description" :value="$category->description" :rows="3" />
                <div class="grid gap-5 sm:grid-cols-3">
                    <x-admin.input name="type" label="Type" :value="$category->type ?: 'actualite'" help="ex. actualite, evenement" />
                    <x-admin.input name="color" label="Couleur" type="color" :value="$category->color ?: '#147a3d'" />
                    <x-admin.input name="order" label="Ordre" type="number" :value="$category->order ?? 0" />
                </div>
            </div>
            <div class="mt-6 flex gap-3">
                <button class="btn-primary">Enregistrer</button>
                <a href="{{ route('admin.categories.index') }}" class="btn-outline-dark">Annuler</a>
            </div>
        </form>
    </div>
@endsection
