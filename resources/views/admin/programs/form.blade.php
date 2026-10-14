@extends('layouts.admin')

@section('title', $program->exists ? 'Modifier le programme' : 'Nouveau programme')
@section('heading', $program->exists ? 'Modifier le programme' : 'Nouveau programme')

@section('content')
    <form action="{{ $program->exists ? route('admin.programs.update', $program) : route('admin.programs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($program->exists) @method('PUT') @endif
        <div class="grid gap-6 lg:grid-cols-3">
            <div class="space-y-6 lg:col-span-2">
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm space-y-5">
                    <x-admin.input name="title" label="Titre du programme" :value="$program->title" required placeholder="ex. Dictée PGL Bénin" />
                    <x-admin.input name="slug" label="Slug" :value="$program->slug" help="Laissez vide pour générer automatiquement." />
                    <x-admin.input name="subtitle" label="Sous-titre" :value="$program->subtitle" />
                    <x-admin.textarea name="excerpt" label="Résumé" :value="$program->excerpt" :rows="3" />
                    <x-admin.editor name="body" label="Description détaillée" :value="$program->body" />
                </div>
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm space-y-5">
                    <h3 class="font-display font-bold text-tauf-ink">SEO</h3>
                    <x-admin.input name="meta_title" label="Titre SEO" :value="$program->meta_title" />
                    <x-admin.textarea name="meta_description" label="Description SEO" :value="$program->meta_description" :rows="3" />
                </div>
            </div>
            <div class="space-y-6">
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm space-y-5">
                    <h3 class="font-display font-bold text-tauf-ink">Paramètres</h3>
                    <x-admin.select name="status" label="Statut" :value="$program->status" :options="['publie' => 'Publié', 'brouillon' => 'Brouillon']" required />
                    <x-admin.input name="order" label="Ordre d'affichage" type="number" :value="$program->order ?? 0" />
                    <x-admin.checkbox name="featured" label="Programme phare" :checked="$program->featured" />
                </div>
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
                    <x-admin.image name="cover" label="Image de couverture" :value="$program->cover" />
                </div>
                <div class="flex flex-col gap-3">
                    <button class="btn-primary w-full">Enregistrer</button>
                    <a href="{{ route('admin.programs.index') }}" class="btn-outline-dark w-full">Annuler</a>
                </div>
            </div>
        </div>
    </form>
@endsection
