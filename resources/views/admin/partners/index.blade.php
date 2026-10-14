@extends('layouts.admin')

@section('title', 'Partenaires')
@section('heading', 'Partenaires')
@section('subheading', 'Gérez les logos et liens de vos partenaires')

@section('content')
    <div class="rounded-2xl border border-gray-100 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-gray-100 p-4">
            <p class="text-sm text-tauf-gray">{{ $partners->total() }} partenaire(s)</p>
            <a href="{{ route('admin.partners.create') }}" class="btn-primary !py-2.5 text-xs">+ Nouveau partenaire</a>
        </div>
        <div class="grid gap-4 p-4 sm:grid-cols-2 lg:grid-cols-4">
            @forelse ($partners as $partner)
                <div class="overflow-hidden rounded-2xl border border-gray-100 p-4">
                    <div class="flex h-20 items-center justify-center">
                        <img src="{{ upload_url($partner->logo) }}" alt="{{ $partner->name }}" class="max-h-16 max-w-full object-contain">
                    </div>
                    <p class="mt-3 text-sm font-semibold text-tauf-ink">{{ $partner->name }}</p>
                    <p class="text-xs text-tauf-gray">{{ $partner->category }} · {{ $partner->is_active ? 'Actif' : 'Inactif' }}</p>
                    <div class="mt-3 flex gap-2">
                        <a href="{{ route('admin.partners.edit', $partner) }}" class="rounded-lg bg-tauf-green-light px-3 py-1.5 text-xs font-semibold text-tauf-green">Modifier</a>
                        <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" data-confirm="Supprimer ce partenaire ?">
                            @csrf @method('DELETE')
                            <button class="rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600">Suppr.</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="col-span-full py-10 text-center text-tauf-gray">Aucun partenaire.</p>
            @endforelse
        </div>
        @if ($partners->hasPages())<div class="border-t border-gray-100 p-4">{{ $partners->links() }}</div>@endif
    </div>
@endsection
