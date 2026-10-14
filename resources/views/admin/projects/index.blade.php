@extends('layouts.admin')

@section('title', 'Réalisations')
@section('heading', 'Réalisations & projets')
@section('subheading', 'Valorisez vos projets et leur impact')

@section('content')
    <div class="rounded-2xl border border-gray-100 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-gray-100 p-4">
            <p class="text-sm text-tauf-gray">{{ $projects->total() }} réalisation(s)</p>
            <a href="{{ route('admin.projects.create') }}" class="btn-primary !py-2.5 text-xs">+ Nouvelle réalisation</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-gray-100 bg-gray-50 text-xs uppercase tracking-wider text-tauf-gray">
                    <tr>
                        <th class="px-4 py-3 font-semibold">Projet</th>
                        <th class="px-4 py-3 font-semibold">Lieu</th>
                        <th class="px-4 py-3 font-semibold">Statut</th>
                        <th class="px-4 py-3 font-semibold">Vues</th>
                        <th class="px-4 py-3 text-right font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($projects as $project)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <img src="{{ upload_url($project->cover) }}" alt="" class="h-10 w-14 rounded-lg object-cover">
                                    <p class="font-semibold text-tauf-ink">{{ Str::limit($project->title, 60) }}</p>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-tauf-gray">{{ $project->location ?: '—' }}</td>
                            <td class="px-4 py-3"><span class="rounded-full px-2.5 py-1 text-[11px] font-bold {{ $project->status === 'publie' ? 'bg-tauf-green-light text-tauf-green' : 'bg-gray-100 text-gray-500' }}">{{ ucfirst($project->status) }}</span></td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('projects.show', $project) }}" target="_blank" class="rounded-lg border border-gray-200 px-3 py-1.5 text-xs font-semibold hover:border-tauf-green hover:text-tauf-green">Voir</a>
                                    <a href="{{ route('admin.projects.edit', $project) }}" class="rounded-lg bg-tauf-green-light px-3 py-1.5 text-xs font-semibold text-tauf-green">Modifier</a>
                                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" data-confirm="Supprimer cette réalisation ?">
                                        @csrf @method('DELETE')
                                        <button class="rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600">Suppr.</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-4 py-10 text-center text-tauf-gray">Aucune réalisation.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($projects->hasPages())<div class="border-t border-gray-100 p-4">{{ $projects->links() }}</div>@endif
    </div>
@endsection
