@extends('layouts.admin')

@section('title', $page->exists ? 'Modifier la page' : 'Nouvelle page')
@section('heading', $page->exists ? 'Modifier la page' : 'Nouvelle page')

@section('content')
    <form action="{{ $page->exists ? route('admin.pages.update', $page) : route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($page->exists) @method('PUT') @endif
        <div class="grid gap-6 lg:grid-cols-3">
            <div class="space-y-6 lg:col-span-2">
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm space-y-5">
                    <x-admin.input name="title" label="Titre" :value="$page->title" required />
                    <x-admin.input name="slug" label="Slug" :value="$page->slug" />
                    <x-admin.input name="subtitle" label="Sous-titre" :value="$page->subtitle" />
                    <x-admin.editor name="body" label="Contenu" :value="$page->body" />
                </div>
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm space-y-5">
                    <h3 class="font-display font-bold text-tauf-ink">SEO</h3>
                    <x-admin.input name="meta_title" label="Titre SEO" :value="$page->meta_title" />
                    <x-admin.textarea name="meta_description" label="Description SEO" :value="$page->meta_description" :rows="3" />
                </div>
            </div>
            <div class="space-y-6">
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm space-y-5">
                    <x-admin.select name="status" label="Statut" :value="$page->status" :options="['publie' => 'Publié', 'brouillon' => 'Brouillon']" required />
                    <x-admin.input name="template" label="Modèle" :value="$page->template ?: 'default'" />
                    <x-admin.input name="order" label="Ordre" type="number" :value="$page->order ?? 0" />
                </div>
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
                    <x-admin.image name="cover" label="Image d'en-tête" :value="$page->cover" />
                </div>
                <div class="flex flex-col gap-3">
                    <button class="btn-primary w-full">Enregistrer</button>
                    <a href="{{ route('admin.pages.index') }}" class="btn-outline-dark w-full">Annuler</a>
                </div>
            </div>
        </div>
    </form>
@endsection
