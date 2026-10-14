@extends('layouts.admin')

@section('title', $event->exists ? 'Modifier l\'événement' : 'Nouvel événement')
@section('heading', $event->exists ? 'Modifier l\'événement' : 'Nouvel événement')

@section('content')
    <form action="{{ $event->exists ? route('admin.events.update', $event) : route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($event->exists) @method('PUT') @endif
        <div class="grid gap-6 lg:grid-cols-3">
            <div class="space-y-6 lg:col-span-2">
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm space-y-5">
                    <x-admin.input name="title" label="Titre de l'événement" :value="$event->title" required />
                    <x-admin.input name="slug" label="Slug" :value="$event->slug" />
                    <x-admin.textarea name="excerpt" label="Résumé" :value="$event->excerpt" :rows="3" />
                    <x-admin.editor name="body" label="Description" :value="$event->body" />
                </div>
            </div>
            <div class="space-y-6">
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm space-y-5">
                    <h3 class="font-display font-bold text-tauf-ink">Détails</h3>
                    <x-admin.input name="starts_at" label="Début" type="datetime-local" :value="$event->starts_at?->format('Y-m-d\TH:i')" required />
                    <x-admin.input name="ends_at" label="Fin" type="datetime-local" :value="$event->ends_at?->format('Y-m-d\TH:i')" />
                    <x-admin.input name="location" label="Lieu" :value="$event->location" />
                    <x-admin.select name="status" label="Statut" :value="$event->status" :options="['publie' => 'Publié', 'brouillon' => 'Brouillon']" required />
                    <x-admin.checkbox name="featured" label="Mettre en avant" :checked="$event->featured" />
                </div>
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
                    <x-admin.image name="cover" label="Image de couverture" :value="$event->cover" />
                </div>
                <div class="flex flex-col gap-3">
                    <button class="btn-primary w-full">Enregistrer</button>
                    <a href="{{ route('admin.events.index') }}" class="btn-outline-dark w-full">Annuler</a>
                </div>
            </div>
        </div>
    </form>
@endsection
