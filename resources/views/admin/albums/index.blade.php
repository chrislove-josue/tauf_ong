@extends('layouts.admin')

@section('title', 'Albums')
@section('heading', 'Albums photos')
@section('subheading', 'Organisez vos galeries photos par album')

@section('content')
    <div class="rounded-2xl border border-gray-100 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-gray-100 p-4">
            <p class="text-sm text-tauf-gray">{{ $albums->total() }} album(s)</p>
            <a href="{{ route('admin.albums.create') }}" class="btn-primary !py-2.5 text-xs">+ Nouvel album</a>
        </div>
        <div class="grid gap-4 p-4 sm:grid-cols-2 lg:grid-cols-4">
            @forelse ($albums as $album)
                <div class="overflow-hidden rounded-2xl border border-gray-100">
                    <img src="{{ upload_url($album->cover) }}" alt="" class="h-36 w-full object-cover">
                    <div class="p-4">
                        <p class="font-semibold text-tauf-ink">{{ $album->name }}</p>
                        <p class="text-xs text-tauf-gray">{{ $album->media_count }} média(s)</p>
                        <div class="mt-3 flex gap-2">
                            <a href="{{ route('admin.albums.edit', $album) }}" class="rounded-lg bg-tauf-green-light px-3 py-1.5 text-xs font-semibold text-tauf-green">Modifier</a>
                            <form action="{{ route('admin.albums.destroy', $album) }}" method="POST" data-confirm="Supprimer cet album ?">
                                @csrf @method('DELETE')
                                <button class="rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600">Suppr.</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-full py-10 text-center text-tauf-gray">Aucun album.</p>
            @endforelse
        </div>
        @if ($albums->hasPages())<div class="border-t border-gray-100 p-4">{{ $albums->links() }}</div>@endif
    </div>
@endsection
