@extends('layouts.admin')

@section('title', $stat->exists ? 'Modifier le chiffre clé' : 'Nouveau chiffre clé')
@section('heading', $stat->exists ? 'Modifier le chiffre clé' : 'Nouveau chiffre clé')

@section('content')
    <div class="mx-auto max-w-xl">
        <form action="{{ $stat->exists ? route('admin.stats.update', $stat) : route('admin.stats.store') }}" method="POST" class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
            @csrf
            @if ($stat->exists) @method('PUT') @endif
            <div class="space-y-5">
                <x-admin.input name="label" label="Libellé" :value="$stat->label" required placeholder="ex. Élèves participants" />
                <div class="grid gap-4 sm:grid-cols-2">
                    <x-admin.input name="value" label="Valeur (nombre)" :value="$stat->value" required help="Uniquement le nombre, ex. 5000" />
                    <x-admin.input name="suffix" label="Suffixe" :value="$stat->suffix" placeholder="ex. +, %, km" />
                </div>
                <x-admin.input name="icon" label="Icône (optionnel)" :value="$stat->icon" />
                <x-admin.input name="order" label="Ordre" type="number" :value="$stat->order ?? 0" />
                <x-admin.checkbox name="is_active" label="Actif" :checked="$stat->is_active" />
            </div>
            <div class="mt-6 flex gap-3">
                <button class="btn-primary">Enregistrer</button>
                <a href="{{ route('admin.stats.index') }}" class="btn-outline-dark">Annuler</a>
            </div>
        </form>
    </div>
@endsection
