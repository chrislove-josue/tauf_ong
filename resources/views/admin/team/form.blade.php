@extends('layouts.admin')

@section('title', $member->exists ? 'Modifier le membre' : 'Nouveau membre')
@section('heading', $member->exists ? 'Modifier le membre' : 'Nouveau membre')

@section('content')
    <div class="mx-auto max-w-2xl">
        <form action="{{ $member->exists ? route('admin.team.update', $member) : route('admin.team.store') }}" method="POST" enctype="multipart/form-data" class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
            @csrf
            @if ($member->exists) @method('PUT') @endif
            <div class="space-y-5">
                <x-admin.input name="name" label="Nom complet" :value="$member->name" required />
                <x-admin.input name="role" label="Fonction" :value="$member->role" />
                <x-admin.select name="group" label="Groupe" :value="$member->group" :options="['bureau' => 'Bureau exécutif', 'conseil' => 'Conseil d\'administration', 'equipe' => 'Équipe technique', 'volontaires' => 'Volontaires']" required />
                <x-admin.textarea name="bio" label="Biographie" :value="$member->bio" :rows="3" />
                <div class="grid gap-4 sm:grid-cols-2">
                    <x-admin.input name="email" label="E-mail" type="email" :value="$member->email" />
                    <x-admin.input name="phone" label="Téléphone" :value="$member->phone" />
                </div>
                <x-admin.input name="order" label="Ordre" type="number" :value="$member->order ?? 0" />
                <x-admin.image name="photo" label="Photo" :value="$member->photo" />
                <x-admin.checkbox name="is_active" label="Actif" :checked="$member->is_active" />
            </div>
            <div class="mt-6 flex gap-3">
                <button class="btn-primary">Enregistrer</button>
                <a href="{{ route('admin.team.index') }}" class="btn-outline-dark">Annuler</a>
            </div>
        </form>
    </div>
@endsection
