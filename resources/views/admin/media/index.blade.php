@extends('layouts.admin')

@section('title', 'Médiathèque')
@section('heading', 'Médiathèque')
@section('subheading', 'Bibliothèque centralisée : images, vidéos et documents')

@section('content')
    <div class="rounded-2xl border border-gray-100 bg-white shadow-sm">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-gray-100 p-4">
            <form action="{{ route('admin.media.index') }}" method="GET" class="flex flex-wrap gap-2">
                <select name="album" class="rounded-xl border border-gray-200 px-4 py-2 text-sm focus:border-tauf-green focus:outline-none">
                    <option value="">Tous les albums</option>
                    @foreach ($albums as $album)<option value="{{ $album->id }}" @selected(request('album') == $album->id)>{{ $album->name }}</option>@endforeach
                </select>
                <select name="type" class="rounded-xl border border-gray-200 px-4 py-2 text-sm focus:border-tauf-green focus:outline-none">
                    <option value="">Tous les types</option>
                    <option value="image" @selected(request('type') === 'image')>Images</option>
                    <option value="video" @selected(request('type') === 'video')>Vidéos</option>
                    <option value="document" @selected(request('type') === 'document')>Documents</option>
                </select>
                <button class="btn-primary !py-2 text-xs">Filtrer</button>
            </form>
            <a href="{{ route('admin.media.create') }}" class="btn-primary !py-2.5 text-xs">+ Téléverser</a>
        </div>

        <div class="grid grid-cols-2 gap-4 p-4 sm:grid-cols-3 lg:grid-cols-5">
            @forelse ($media as $item)
                <div class="group overflow-hidden rounded-2xl border border-gray-100">
                    @if ($item->type === 'image')
                        <img src="{{ upload_url($item->file_path) }}" alt="{{ $item->alt }}" class="h-32 w-full object-cover">
                    @else
                        <div class="flex h-32 w-full items-center justify-center bg-gray-100 text-3xl">
                            {{ $item->type === 'video' ? '🎬' : '📄' }}
                        </div>
                    @endif
                    <div class="p-3">
                        <p class="truncate text-xs font-semibold text-tauf-ink">{{ $item->title ?: $item->file_path }}</p>
                        <p class="text-[10px] uppercase text-tauf-gray">{{ $item->type }} · {{ number_format($item->size / 1024, 0) }} Ko</p>
                        <div class="mt-2 flex gap-1">
                            <a href="{{ route('admin.media.edit', $item) }}" class="rounded-lg bg-tauf-green-light px-2 py-1 text-[11px] font-semibold text-tauf-green">Modif.</a>
                            <form action="{{ route('admin.media.destroy', $item) }}" method="POST" data-confirm="Supprimer ce média ?">
                                @csrf @method('DELETE')
                                <button class="rounded-lg bg-red-50 px-2 py-1 text-[11px] font-semibold text-red-600">Suppr.</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-full py-10 text-center text-tauf-gray">Aucun média.</p>
            @endforelse
        </div>
        @if ($media->hasPages())<div class="border-t border-gray-100 p-4">{{ $media->links() }}</div>@endif
    </div>
@endsection
