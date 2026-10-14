@extends('layouts.admin')

@section('title', 'Bannières')
@section('heading', 'Bannières du site')
@section('subheading', 'Gérez les slides de la page d\'accueil')

@section('content')
    <div class="rounded-2xl border border-gray-100 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-gray-100 p-4">
            <p class="text-sm text-tauf-gray">{{ $slides->total() }} bannière(s)</p>
            <a href="{{ route('admin.slides.create') }}" class="btn-primary !py-2.5 text-xs">+ Nouvelle bannière</a>
        </div>
        <div class="grid gap-4 p-4 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($slides as $slide)
                <div class="overflow-hidden rounded-2xl border border-gray-100">
                    <img src="{{ upload_url($slide->image) }}" alt="" class="h-36 w-full object-cover">
                    <div class="p-4">
                        <p class="font-semibold text-tauf-ink">{{ $slide->title }}</p>
                        <p class="text-xs text-tauf-gray">{{ $slide->subtitle }}</p>
                        <p class="mt-1 text-xs">{{ $slide->is_active ? '✅ Active' : '⏸ Inactive' }} · ordre {{ $slide->order }}</p>
                        <div class="mt-3 flex gap-2">
                            <a href="{{ route('admin.slides.edit', $slide) }}" class="rounded-lg bg-tauf-green-light px-3 py-1.5 text-xs font-semibold text-tauf-green">Modifier</a>
                            <form action="{{ route('admin.slides.destroy', $slide) }}" method="POST" data-confirm="Supprimer cette bannière ?">
                                @csrf @method('DELETE')
                                <button class="rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600">Suppr.</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-full py-10 text-center text-tauf-gray">Aucune bannière. Un visuel par défaut est utilisé sur la page d'accueil.</p>
            @endforelse
        </div>
        @if ($slides->hasPages())<div class="border-t border-gray-100 p-4">{{ $slides->links() }}</div>@endif
    </div>
@endsection
