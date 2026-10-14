@extends('layouts.admin')

@section('title', 'Programmes')
@section('heading', 'Programmes')
@section('subheading', 'Présentez les programmes phares, dont la Dictée PGL Bénin')

@section('content')
    <div class="rounded-2xl border border-gray-100 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-gray-100 p-4">
            <p class="text-sm text-tauf-gray">{{ $programs->total() }} programme(s)</p>
            <a href="{{ route('admin.programs.create') }}" class="btn-primary !py-2.5 text-xs">+ Nouveau programme</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-gray-100 bg-gray-50 text-xs uppercase tracking-wider text-tauf-gray">
                    <tr>
                        <th class="px-4 py-3 font-semibold">Programme</th>
                        <th class="px-4 py-3 font-semibold">Statut</th>
                        <th class="px-4 py-3 font-semibold">Mise en avant</th>
                        <th class="px-4 py-3 font-semibold">Ordre</th>
                        <th class="px-4 py-3 font-semibold">Vues</th>
                        <th class="px-4 py-3 text-right font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($programs as $program)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <img src="{{ upload_url($program->cover) }}" alt="" class="h-10 w-14 rounded-lg object-cover">
                                    <div>
                                        <p class="font-semibold text-tauf-ink">{{ $program->title }}</p>
                                        <p class="text-xs text-tauf-gray">{{ $program->subtitle }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3"><span class="rounded-full px-2.5 py-1 text-[11px] font-bold {{ $program->status === 'publie' ? 'bg-tauf-green-light text-tauf-green' : 'bg-gray-100 text-gray-500' }}">{{ ucfirst($program->status) }}</span></td>
                            <td class="px-4 py-3">{!! $program->featured ? '<span class="text-tauf-green">Oui</span>' : '<span class="text-tauf-gray">Non</span>' !!}</td>
                            <td class="px-4 py-3 text-tauf-gray">{{ $program->order }}</td>
                            <td class="px-4 py-3 text-tauf-gray">{{ number_format($program->views, 0, ',', ' ') }}</td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('programs.show', $program) }}" target="_blank" class="rounded-lg border border-gray-200 px-3 py-1.5 text-xs font-semibold hover:border-tauf-green hover:text-tauf-green">Voir</a>
                                    <a href="{{ route('admin.programs.edit', $program) }}" class="rounded-lg bg-tauf-green-light px-3 py-1.5 text-xs font-semibold text-tauf-green">Modifier</a>
                                    <form action="{{ route('admin.programs.destroy', $program) }}" method="POST" data-confirm="Supprimer ce programme ?">
                                        @csrf @method('DELETE')
                                        <button class="rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600">Suppr.</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-4 py-10 text-center text-tauf-gray">Aucun programme.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($programs->hasPages())<div class="border-t border-gray-100 p-4">{{ $programs->links() }}</div>@endif
    </div>
@endsection
