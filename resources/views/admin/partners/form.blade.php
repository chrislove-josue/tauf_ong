@extends('layouts.admin')

@section('title', $partner->exists ? 'Modifier le partenaire' : 'Nouveau partenaire')
@section('heading', $partner->exists ? 'Modifier le partenaire' : 'Nouveau partenaire')

@section('content')
    <div class="mx-auto max-w-2xl">
        <form action="{{ $partner->exists ? route('admin.partners.update', $partner) : route('admin.partners.store') }}" method="POST" enctype="multipart/form-data" class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
            @csrf
            @if ($partner->exists) @method('PUT') @endif
            <div class="space-y-5">
                <x-admin.input name="name" label="Nom du partenaire" :value="$partner->name" required />
                <x-admin.input name="url" label="Site web" type="url" :value="$partner->url" placeholder="https://" />
                <x-admin.input name="category" label="Catégorie" :value="$partner->category" help="ex. Partenaires techniques, financiers..." />
                <x-admin.input name="order" label="Ordre" type="number" :value="$partner->order ?? 0" />
                <x-admin.image name="logo" label="Logo" :value="$partner->logo" help="PNG ou SVG transparent recommandé." />
                <x-admin.checkbox name="is_active" label="Actif (visible sur le site)" :checked="$partner->is_active" />
            </div>
            <div class="mt-6 flex gap-3">
                <button class="btn-primary">Enregistrer</button>
                <a href="{{ route('admin.partners.index') }}" class="btn-outline-dark">Annuler</a>
            </div>
        </form>
    </div>
@endsection
