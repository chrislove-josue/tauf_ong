@extends('layouts.admin')

@section('title', 'Catégories')
@section('heading', 'Catégories')
@section('subheading', 'Organisez vos contenus par catégorie')

@section('content')
    <div class="rounded-2xl border border-gray-100 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-gray-100 p-4">
            <p class="text-sm text-tauf-gray">{{ $categories->total() }} catégorie(s)</p>
            <a href="{{ route('admin.categories.create') }}" class="btn-primary !py-2.5 text-xs">+ Nouvelle catégorie</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-gray-100 bg-gray-50 text-xs uppercase tracking-wider text-tauf-gray">
                    <tr>
                        <th class="px-4 py-3 font-semibold">Nom</th>
                        <th class="px-4 py-3 font-semibold">Type</th>
                        <th class="px-4 py-3 font-semibold">Articles</th>
                        <th class="px-4 py-3 font-semibold">Ordre</th>
                        <th class="px-4 py-3 text-right font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($categories as $category)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    @if ($category->color)<span class="h-3 w-3 rounded-full" style="background: {{ $category->color }}"></span>@endif
                                    <span class="font-semibold text-tauf-ink">{{ $category->name }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-tauf-gray">{{ $category->type }}</td>
                            <td class="px-4 py-3 text-tauf-gray">{{ $category->posts_count }}</td>
                            <td class="px-4 py-3 text-tauf-gray">{{ $category->order }}</td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="rounded-lg bg-tauf-green-light px-3 py-1.5 text-xs font-semibold text-tauf-green">Modifier</a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" data-confirm="Supprimer cette catégorie ?">
                                        @csrf @method('DELETE')
                                        <button class="rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600">Suppr.</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-10 text-center text-tauf-gray">Aucune catégorie.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($categories->hasPages())<div class="border-t border-gray-100 p-4">{{ $categories->links() }}</div>@endif
    </div>
@endsection
