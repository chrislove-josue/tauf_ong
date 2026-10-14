@extends('layouts.admin')

@section('title', 'Événements')
@section('heading', 'Événements & agenda')
@section('subheading', 'Gérez le calendrier des événements à venir et passés')

@section('content')
    <div class="rounded-2xl border border-gray-100 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-gray-100 p-4">
            <p class="text-sm text-tauf-gray">{{ $events->total() }} événement(s)</p>
            <a href="{{ route('admin.events.create') }}" class="btn-primary !py-2.5 text-xs">+ Nouvel événement</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-gray-100 bg-gray-50 text-xs uppercase tracking-wider text-tauf-gray">
                    <tr>
                        <th class="px-4 py-3 font-semibold">Événement</th>
                        <th class="px-4 py-3 font-semibold">Date</th>
                        <th class="px-4 py-3 font-semibold">Lieu</th>
                        <th class="px-4 py-3 font-semibold">Statut</th>
                        <th class="px-4 py-3 font-semibold">Vues</th>
                        <th class="px-4 py-3 text-right font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($events as $event)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-semibold text-tauf-ink">{{ Str::limit($event->title, 50) }}</td>
                            <td class="px-4 py-3 text-tauf-gray">{{ $event->starts_at?->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-3 text-tauf-gray">{{ $event->location ?: '—' }}</td>
                            <td class="px-4 py-3"><span class="rounded-full px-2.5 py-1 text-[11px] font-bold {{ $event->status === 'publie' ? 'bg-tauf-green-light text-tauf-green' : 'bg-gray-100 text-gray-500' }}">{{ ucfirst($event->status) }}</span></td>
                            <td class="px-4 py-3 text-tauf-gray">{{ number_format($event->views, 0, ',', ' ') }}</td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('events.show', $event) }}" target="_blank" class="rounded-lg border border-gray-200 px-3 py-1.5 text-xs font-semibold hover:border-tauf-green hover:text-tauf-green">Voir</a>
                                    <a href="{{ route('admin.events.edit', $event) }}" class="rounded-lg bg-tauf-green-light px-3 py-1.5 text-xs font-semibold text-tauf-green">Modifier</a>
                                    <form action="{{ route('admin.events.destroy', $event) }}" method="POST" data-confirm="Supprimer cet événement ?">
                                        @csrf @method('DELETE')
                                        <button class="rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600">Suppr.</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-4 py-10 text-center text-tauf-gray">Aucun événement.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($events->hasPages())<div class="border-t border-gray-100 p-4">{{ $events->links() }}</div>@endif
    </div>
@endsection
