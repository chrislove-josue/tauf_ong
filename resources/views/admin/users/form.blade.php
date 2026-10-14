@extends('layouts.admin')

@section('title', $user->exists ? 'Modifier l\'utilisateur' : 'Nouvel utilisateur')
@section('heading', $user->exists ? 'Modifier l\'utilisateur' : 'Nouvel utilisateur')

@section('content')
    <div class="mx-auto max-w-2xl">
        <form action="{{ $user->exists ? route('admin.users.update', $user) : route('admin.users.store') }}" method="POST" enctype="multipart/form-data" class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
            @csrf
            @if ($user->exists) @method('PUT') @endif
            <div class="space-y-5">
                <x-admin.input name="name" label="Nom complet" :value="$user->name" required />
                <x-admin.input name="email" label="E-mail" type="email" :value="$user->email" required />
                <x-admin.select name="role" label="Rôle" :value="$user->role" :options="\App\Models\User::ROLES" required
                    help="Super-admin et Admin gèrent aussi les utilisateurs. Éditeur gère les contenus. Contributeur propose des contenus." />
                <x-admin.input name="phone" label="Téléphone" :value="$user->phone" />
                <x-admin.textarea name="bio" label="Biographie" :value="$user->bio" :rows="2" />
                <div class="rounded-xl border border-gray-100 p-4 space-y-4">
                    <x-admin.input name="password" label="Mot de passe" type="password" :help="$user->exists ? 'Laissez vide pour ne pas modifier.' : 'Minimum 8 caractères.'" />
                    <x-admin.input name="password_confirmation" label="Confirmer le mot de passe" type="password" />
                </div>
                <x-admin.image name="photo" label="Photo" :value="$user->photo" />
                <x-admin.checkbox name="is_active" label="Compte actif" :checked="$user->is_active" />
            </div>
            <div class="mt-6 flex gap-3">
                <button class="btn-primary">Enregistrer</button>
                <a href="{{ route('admin.users.index') }}" class="btn-outline-dark">Annuler</a>
            </div>
        </form>
    </div>
@endsection
