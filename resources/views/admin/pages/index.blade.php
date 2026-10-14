@extends('layouts.admin')

@section('title', 'Pages')
@section('heading', 'Pages institutionnelles')
@section('subheading', 'Gérez les pages libres du site (mentions légales, FAQ, etc.)')

@section('content')
    <div class="rounded-2xl border border-gray-100 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-gray-100 p-4">
            <p class="text-sm text-tauf-gray">{{ $pages->total() }} page(s)</p>
            <a href="{{ route('admin.pages.create') }}" class="btn-primary !py-2.5 text-xs">+ Nouvelle page</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-gray-100 bg-gray-50 text-xs uppercase tracking-wider text-tauf-gray">
                    <tr>
                        <th class="px-4 py-3 font-semibold">Titre</th>
                        <th class="px-4 py-3 font-semibold">Slug</th>
                        <th class="px-4 py-3 font-semibold">Statut</th>
                        <th class="px-4 py-3 text-right font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($pages as $page)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-semibold text-tauf-ink">{{ $page->title }}</td>
                            <td class="px-4 py-3 text-tauf-gray">/pages/{{ $page->slug }}</td>
                            <td class="px-4 py-3"><span class="rounded-full px-2.5 py-1 text-[11px] font-bold {{ $page->status === 'publie' ? 'bg-tauf-green-light text-tauf-green' : 'bg-gray-100 text-gray-500' }}">{{ ucfirst($page->status) }}</span></td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('pages.show', $page) }}" target="_blank" class="rounded-lg border border-gray-200 px-3 py-1.5 text-xs font-semibold hover:border-tauf-green hover:text-tauf-green">Voir</a>
                                    <a href="{{ route('admin.pages.edit', $page) }}" class="rounded-lg bg-tauf-green-light px-3 py-1.5 text-xs font-semibold text-tauf-green">Modifier</a>
                                    <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" data-confirm="Supprimer cette page ?">
                                        @csrf @method('DELETE')
                                        <button class="rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600">Suppr.</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-4 py-10 text-center text-tauf-gray">Aucune page.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($pages->hasPages())<div class="border-t border-gray-100 p-4">{{ $pages->links() }}</div>@endif
    </div>
@endsection
