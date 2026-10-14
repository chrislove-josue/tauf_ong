@extends('layouts.admin')

@section('title', 'Abonnés newsletter')
@section('heading', 'Abonnés à la newsletter')
@section('subheading', 'Gérez et exportez votre liste d\'abonnés')

@section('content')
    <div class="rounded-2xl border border-gray-100 bg-white shadow-sm">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-gray-100 p-4">
            <form action="{{ route('admin.subscribers.index') }}" method="GET" class="flex gap-2">
                <input type="search" name="q" value="{{ request('q') }}" placeholder="Rechercher par e-mail..." class="rounded-xl border border-gray-200 px-4 py-2 text-sm focus:border-tauf-green focus:outline-none">
                <button class="btn-primary !py-2 text-xs">Rechercher</button>
            </form>
            <a href="{{ route('admin.subscribers.export') }}" class="btn-outline-dark !py-2.5 text-xs">Exporter en CSV</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-gray-100 bg-gray-50 text-xs uppercase tracking-wider text-tauf-gray">
                    <tr>
                        <th class="px-4 py-3 font-semibold">E-mail</th>
                        <th class="px-4 py-3 font-semibold">Nom</th>
                        <th class="px-4 py-3 font-semibold">Statut</th>
                        <th class="px-4 py-3 font-semibold">Inscription</th>
                        <th class="px-4 py-3 text-right font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($subscribers as $subscriber)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-semibold text-tauf-ink">{{ $subscriber->email }}</td>
                            <td class="px-4 py-3 text-tauf-gray">{{ $subscriber->name ?: '—' }}</td>
                            <td class="px-4 py-3"><span class="rounded-full px-2.5 py-1 text-[11px] font-bold {{ $subscriber->is_active ? 'bg-tauf-green-light text-tauf-green' : 'bg-gray-100 text-gray-500' }}">{{ $subscriber->is_active ? 'Actif' : 'Inactif' }}</span></td>
                            <td class="px-4 py-3 text-xs text-tauf-gray">{{ $subscriber->subscribed_at?->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-3 text-right">
                                <form action="{{ route('admin.subscribers.destroy', $subscriber) }}" method="POST" data-confirm="Supprimer cet abonné ?">
                                    @csrf @method('DELETE')
                                    <button class="rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600">Suppr.</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-10 text-center text-tauf-gray">Aucun abonné.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($subscribers->hasPages())<div class="border-t border-gray-100 p-4">{{ $subscribers->links() }}</div>@endif
    </div>
@endsection
