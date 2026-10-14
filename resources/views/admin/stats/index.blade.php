@extends('layouts.admin')

@section('title', 'Chiffres clés')
@section('heading', 'Chiffres clés / impact')
@section('subheading', 'Compteurs animés affichés sur la page d\'accueil')

@section('content')
    <div class="rounded-2xl border border-gray-100 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-gray-100 p-4">
            <p class="text-sm text-tauf-gray">{{ $stats->total() }} chiffre(s)</p>
            <a href="{{ route('admin.stats.create') }}" class="btn-primary !py-2.5 text-xs">+ Nouveau chiffre</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-gray-100 bg-gray-50 text-xs uppercase tracking-wider text-tauf-gray">
                    <tr>
                        <th class="px-4 py-3 font-semibold">Libellé</th>
                        <th class="px-4 py-3 font-semibold">Valeur</th>
                        <th class="px-4 py-3 font-semibold">Ordre</th>
                        <th class="px-4 py-3 font-semibold">Statut</th>
                        <th class="px-4 py-3 text-right font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($stats as $stat)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-semibold text-tauf-ink">{{ $stat->label }}</td>
                            <td class="px-4 py-3 text-tauf-gray">{{ $stat->value }}{{ $stat->suffix }}</td>
                            <td class="px-4 py-3 text-tauf-gray">{{ $stat->order }}</td>
                            <td class="px-4 py-3"><span class="rounded-full px-2.5 py-1 text-[11px] font-bold {{ $stat->is_active ? 'bg-tauf-green-light text-tauf-green' : 'bg-gray-100 text-gray-500' }}">{{ $stat->is_active ? 'Actif' : 'Inactif' }}</span></td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.stats.edit', $stat) }}" class="rounded-lg bg-tauf-green-light px-3 py-1.5 text-xs font-semibold text-tauf-green">Modifier</a>
                                    <form action="{{ route('admin.stats.destroy', $stat) }}" method="POST" data-confirm="Supprimer ce chiffre clé ?">
                                        @csrf @method('DELETE')
                                        <button class="rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600">Suppr.</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-10 text-center text-tauf-gray">Aucun chiffre clé.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($stats->hasPages())<div class="border-t border-gray-100 p-4">{{ $stats->links() }}</div>@endif
    </div>
@endsection
