@extends('layouts.admin')

@section('title', 'Équipe')
@section('heading', 'Équipe & gouvernance')
@section('subheading', 'Gérez les membres du bureau et de l\'équipe')

@section('content')
    <div class="rounded-2xl border border-gray-100 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-gray-100 p-4">
            <p class="text-sm text-tauf-gray">{{ $members->total() }} membre(s)</p>
            <a href="{{ route('admin.team.create') }}" class="btn-primary !py-2.5 text-xs">+ Nouveau membre</a>
        </div>
        <div class="grid gap-4 p-4 sm:grid-cols-2 lg:grid-cols-4">
            @forelse ($members as $member)
                <div class="overflow-hidden rounded-2xl border border-gray-100 text-center">
                    <img src="{{ upload_url($member->photo, 'images/placeholder.svg') }}" alt="" class="h-40 w-full object-cover">
                    <div class="p-4">
                        <p class="font-semibold text-tauf-ink">{{ $member->name }}</p>
                        <p class="text-xs text-tauf-green">{{ $member->role }}</p>
                        <p class="text-xs text-tauf-gray">{{ ucfirst($member->group) }}</p>
                        <div class="mt-3 flex justify-center gap-2">
                            <a href="{{ route('admin.team.edit', $member) }}" class="rounded-lg bg-tauf-green-light px-3 py-1.5 text-xs font-semibold text-tauf-green">Modifier</a>
                            <form action="{{ route('admin.team.destroy', $member) }}" method="POST" data-confirm="Supprimer ce membre ?">
                                @csrf @method('DELETE')
                                <button class="rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600">Suppr.</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-full py-10 text-center text-tauf-gray">Aucun membre.</p>
            @endforelse
        </div>
        @if ($members->hasPages())<div class="border-t border-gray-100 p-4">{{ $members->links() }}</div>@endif
    </div>
@endsection
