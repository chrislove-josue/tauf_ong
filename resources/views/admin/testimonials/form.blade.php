@extends('layouts.admin')

@section('title', $testimonial->exists ? 'Modifier le témoignage' : 'Nouveau témoignage')
@section('heading', $testimonial->exists ? 'Modifier le témoignage' : 'Nouveau témoignage')

@section('content')
    <div class="mx-auto max-w-2xl">
        <form action="{{ $testimonial->exists ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
            @csrf
            @if ($testimonial->exists) @method('PUT') @endif
            <div class="space-y-5">
                <x-admin.input name="name" label="Nom" :value="$testimonial->name" required />
                <x-admin.input name="role" label="Fonction / qualité" :value="$testimonial->role" />
                <x-admin.textarea name="content" label="Témoignage" :value="$testimonial->content" :rows="4" required />
                <x-admin.input name="order" label="Ordre" type="number" :value="$testimonial->order ?? 0" />
                <x-admin.image name="photo" label="Photo" :value="$testimonial->photo" />
                <x-admin.checkbox name="is_active" label="Actif" :checked="$testimonial->is_active" />
            </div>
            <div class="mt-6 flex gap-3">
                <button class="btn-primary">Enregistrer</button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn-outline-dark">Annuler</a>
            </div>
        </form>
    </div>
@endsection
