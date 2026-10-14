@extends('layouts.admin')

@section('title', 'Articles')
@section('heading', 'Articles & actualités')
@section('subheading', 'Gérez les actualités, communiqués et articles du site')

@section('content')
    <div class="rounded-2xl border border-gray-100 bg-white shadow-sm">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-gray-100 p-4">
            <form action="{{ route('admin.posts.index') }}" method="GET" class="flex flex-wrap gap-2">
                <input type="search" name="q" value="{{ request('q') }}" placeholder="Rechercher un article..." class="rounded-xl border border-gray-200 px-4 py-2 text-sm focus:border-tauf-green focus:outline-none">
                <select name="statut" class="rounded-xl border border-gray-200 px-4 py-2 text-sm focus:border-tauf-green focus:outline-none">
                    <option value="">Tous les statuts</option>
                    @foreach (\App\Models\Post::STATUSES as $key => $label)
                        <option value="{{ $key }}" @selected(request('statut') === $key)>{{ $label }}</option>
                    @endforeach
                </select>
                <button class="btn-primary !py-2 text-xs">Filtrer</button>
            </form>
            <a href="{{ route('admin.posts.create') }}" class="btn-primary !py-2.5 text-xs">+ Nouvel article</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-gray-100 bg-gray-50 text-xs uppercase tracking-wider text-tauf-gray">
                    <tr>
                        <th class="px-4 py-3 font-semibold">Article</th>
                        <th class="px-4 py-3 font-semibold">Catégorie</th>
                        <th class="px-4 py-3 font-semibold">Statut</th>
                        <th class="px-4 py-3 font-semibold">Publication</th>
                        <th class="px-4 py-3 text-right font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($posts as $post)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <img src="{{ upload_url($post->cover) }}" alt="" class="h-10 w-14 rounded-lg object-cover">
                                    <div>
                                        <p class="font-semibold text-tauf-ink">{{ Str::limit($post->title, 60) }}</p>
                                        <p class="text-xs text-tauf-gray">{{ $post->views }} vues</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-tauf-gray">{{ $post->category->name ?? '—' }}</td>
                            <td class="px-4 py-3">
                                <span class="rounded-full px-2.5 py-1 text-[11px] font-bold {{ $post->status === 'publie' ? 'bg-tauf-green-light text-tauf-green' : ($post->status === 'en_attente' ? 'bg-tauf-gold/20 text-tauf-gold-dark' : 'bg-gray-100 text-gray-500') }}">
                                    {{ \App\Models\Post::STATUSES[$post->status] ?? $post->status }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-xs text-tauf-gray">{{ $post->published_at?->format('d/m/Y H:i') ?? '—' }}</td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('posts.show', $post) }}" target="_blank" class="rounded-lg border border-gray-200 px-3 py-1.5 text-xs font-semibold hover:border-tauf-green hover:text-tauf-green">Voir</a>
                                    <a href="{{ route('admin.posts.edit', $post) }}" class="rounded-lg bg-tauf-green-light px-3 py-1.5 text-xs font-semibold text-tauf-green">Modifier</a>
                                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" data-confirm="Supprimer cet article ?">
                                        @csrf @method('DELETE')
                                        <button class="rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600">Suppr.</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-10 text-center text-tauf-gray">Aucun article trouvé.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($posts->hasPages())
            <div class="border-t border-gray-100 p-4">{{ $posts->links() }}</div>
        @endif
    </div>
@endsection
