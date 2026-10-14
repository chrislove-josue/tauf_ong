@extends('layouts.admin')

@section('title', 'Mon profil')
@section('heading', 'Mon profil')
@section('subheading', 'Modifiez vos informations personnelles et votre mot de passe')

@section('content')
    <div class="mx-auto max-w-3xl">
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
            @csrf @method('PUT')
            <div class="grid gap-6 sm:grid-cols-3">
                <div class="sm:col-span-1">
                    <x-admin.image name="photo" label="Photo de profil" :value="$user->photo" />
                    <div class="mt-4 rounded-xl bg-tauf-cream p-4 text-sm">
                        <p class="font-semibold text-tauf-ink">{{ $user->name }}</p>
                        <p class="text-tauf-gray">{{ $user->roleLabel() }}</p>
                        <p class="mt-2 text-xs text-tauf-gray">Dernière connexion : {{ $user->last_login_at?->format('d/m/Y H:i') ?? '—' }}</p>
                    </div>
                </div>
                <div class="space-y-5 sm:col-span-2">
                    <x-admin.input name="name" label="Nom complet" :value="$user->name" required />
                    <x-admin.input name="email" label="E-mail" type="email" :value="$user->email" required />
                    <x-admin.input name="phone" label="Téléphone" :value="$user->phone" />
                    <x-admin.textarea name="bio" label="Biographie" :value="$user->bio" :rows="3" />
                    <div class="rounded-xl border border-gray-100 p-4">
                        <p class="mb-3 text-sm font-semibold text-tauf-ink">Changer le mot de passe</p>
                        <div class="space-y-4">
                            <x-admin.input name="password" label="Nouveau mot de passe" type="password" help="Laissez vide pour conserver le mot de passe actuel." />
                            <x-admin.input name="password_confirmation" label="Confirmer le mot de passe" type="password" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex gap-3">
                <button class="btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
@endsection
