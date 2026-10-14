@extends('layouts.admin')

@section('title', $post->exists ? 'Modifier un article' : 'Nouvel article')
@section('heading', $post->exists ? 'Modifier l\'article' : 'Nouvel article')
@section('subheading', $post->exists ? $post->title : 'Créer une nouvelle actualité')

@section('content')
    <form action="{{ $post->exists ? route('admin.posts.update', $post) : route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($post->exists) @method('PUT') @endif

        <div class="grid gap-6 lg:grid-cols-3">
            <div class="space-y-6 lg:col-span-2">
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
                    <div class="space-y-5">
                        <x-admin.input name="title" label="Titre" :value="$post->title" required placeholder="Titre de l'article" />
                        <x-admin.input name="slug" label="Slug (URL)" :value="$post->slug" help="Laissez vide pour générer automatiquement." placeholder="titre-de-larticle" />
                        <x-admin.textarea name="excerpt" label="Résumé (chapô)" :value="$post->excerpt" :rows="3" help="Bref résumé affiché dans les listes (max 500 caractères)." />
                        <x-admin.editor name="body" label="Contenu de l'article" :value="$post->body" />
                    </div>
                </div>

                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
                    <h3 class="mb-4 font-display font-bold text-tauf-ink">Référencement (SEO)</h3>
                    <div class="space-y-5">
                        <x-admin.input name="meta_title" label="Titre SEO" :value="$post->meta_title" />
                        <x-admin.textarea name="meta_description" label="Description SEO" :value="$post->meta_description" :rows="3" />
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
                    <h3 class="mb-4 font-display font-bold text-tauf-ink">Publication</h3>
                    <div class="space-y-5">
                        <x-admin.select name="status" label="Statut" :value="$post->status" :options="\App\Models\Post::STATUSES" required />
                        <x-admin.input name="published_at" label="Date de publication" type="datetime-local" :value="$post->published_at?->format('Y-m-d\TH:i')" help="Laissez vide pour publier immédiatement." />
                        <x-admin.checkbox name="featured" label="Mettre en avant" :checked="$post->featured" />
                    </div>
                </div>

                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
                    <h3 class="mb-4 font-display font-bold text-tauf-ink">Organisation</h3>
                    <div class="space-y-5">
                        <x-admin.select name="category_id" label="Catégorie" :value="$post->category_id" :options="$categories->pluck('name', 'id')->toArray()" placeholder="— Aucune —" />
                        <x-admin.image name="cover" label="Image de couverture" :value="$post->cover" help="Format recommandé : 1200×750 px." />
                    </div>
                </div>

                <div class="flex flex-col gap-3">
                    <button type="submit" class="btn-primary w-full">Enregistrer</button>
                    <a href="{{ route('admin.posts.index') }}" class="btn-outline-dark w-full">Annuler</a>
                </div>
            </div>
        </div>
    </form>
@endsection
