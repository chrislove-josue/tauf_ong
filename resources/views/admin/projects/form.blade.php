@extends('layouts.admin')

@section('title', $project->exists ? 'Modifier la réalisation' : 'Nouvelle réalisation')
@section('heading', $project->exists ? 'Modifier la réalisation' : 'Nouvelle réalisation')

@section('content')
    <form action="{{ $project->exists ? route('admin.projects.update', $project) : route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($project->exists) @method('PUT') @endif
        <div class="grid gap-6 lg:grid-cols-3">
            <div class="space-y-6 lg:col-span-2">
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm space-y-5">
                    <x-admin.input name="title" label="Titre du projet" :value="$project->title" required />
                    <x-admin.input name="slug" label="Slug" :value="$project->slug" />
                    <x-admin.textarea name="excerpt" label="Résumé" :value="$project->excerpt" :rows="3" />
                    <x-admin.editor name="context" label="Contexte" :value="$project->context" />
                    <x-admin.editor name="objectives" label="Objectifs" :value="$project->objectives" />
                    <x-admin.editor name="results" label="Résultats" :value="$project->results" />
                </div>

                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
                    <h3 class="mb-4 font-display font-bold text-tauf-ink">Indicateurs chiffrés</h3>
                    @php $indicators = old('indicators', $project->indicators ?? []); @endphp
                    <div class="space-y-3">
                        @for ($i = 0; $i < max(3, count($indicators)); $i++)
                            <div class="grid gap-3 sm:grid-cols-2">
                                <input type="text" name="indicators[{{ $i }}][label]" value="{{ $indicators[$i]['label'] ?? '' }}" placeholder="Libellé (ex. Élèves touchés)" class="rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-tauf-green focus:outline-none">
                                <input type="text" name="indicators[{{ $i }}][value]" value="{{ $indicators[$i]['value'] ?? '' }}" placeholder="Valeur (ex. 5000)" class="rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-tauf-green focus:outline-none">
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm space-y-5">
                    <h3 class="font-display font-bold text-tauf-ink">Paramètres</h3>
                    <x-admin.select name="status" label="Statut" :value="$project->status" :options="['publie' => 'Publié', 'brouillon' => 'Brouillon']" required />
                    <x-admin.input name="location" label="Lieu" :value="$project->location" />
                    <div class="grid grid-cols-2 gap-3">
                        <x-admin.input name="started_at" label="Début" type="date" :value="$project->started_at?->format('Y-m-d')" />
                        <x-admin.input name="ended_at" label="Fin" type="date" :value="$project->ended_at?->format('Y-m-d')" />
                    </div>
                    <x-admin.input name="order" label="Ordre" type="number" :value="$project->order ?? 0" />
                    <x-admin.checkbox name="featured" label="Mettre en avant" :checked="$project->featured" />
                </div>
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm space-y-5">
                    <x-admin.image name="cover" label="Image de couverture" :value="$project->cover" />
                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-tauf-ink">Galerie photos</label>
                        <input type="file" name="gallery[]" multiple accept="image/*" class="w-full rounded-xl border border-gray-200 px-3 py-2 text-sm file:mr-3 file:rounded-full file:border-0 file:bg-tauf-green-light file:px-4 file:py-1.5 file:text-tauf-green">
                        @if ($project->gallery)
                            <div class="mt-3 grid grid-cols-3 gap-2">
                                @foreach ($project->gallery as $img)<img src="{{ upload_url($img) }}" class="h-16 w-full rounded-lg object-cover">@endforeach
                            </div>
                        @endif
                    </div>
                </div>
                <div class="flex flex-col gap-3">
                    <button class="btn-primary w-full">Enregistrer</button>
                    <a href="{{ route('admin.projects.index') }}" class="btn-outline-dark w-full">Annuler</a>
                </div>
            </div>
        </div>
    </form>
@endsection
