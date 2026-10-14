@extends('layouts.admin')

@section('title', 'Tableau de bord')
@section('heading', 'Tableau de bord')
@section('subheading', 'Vue d\'ensemble de votre site · Bienvenue ' . auth()->user()->name)

@section('content')
    {{-- Statistiques --}}
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        @php
            $cards = [
                ['label' => 'Articles publiés', 'value' => $counts['published'], 'total' => $counts['posts'].' au total', 'icon' => 'M4 19h16M4 5h16v10H4z', 'color' => 'bg-tauf-green'],
                ['label' => 'Réalisations', 'value' => $counts['projects'], 'total' => 'projets', 'icon' => 'M3 21h18M5 21V7l7-4 7 4v14', 'color' => 'bg-tauf-gold'],
                ['label' => 'Messages reçus', 'value' => $counts['messages'], 'total' => $counts['unread'].' non lus', 'icon' => 'M4 4h16v12H5.2L4 18z', 'color' => 'bg-tauf-red'],
                ['label' => 'Abonnés newsletter', 'value' => $counts['subscribers'], 'total' => 'actifs', 'icon' => 'M22 6l-10 7L2 6M2 4h20v16H2z', 'color' => 'bg-tauf-ink'],
            ];
        @endphp
        @foreach ($cards as $card)
            <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl {{ $card['color'] }} text-white">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="{{ $card['icon'] }}"/></svg>
                    </span>
                    <span class="font-display text-3xl font-extrabold text-tauf-ink">{{ $card['value'] }}</span>
                </div>
                <p class="mt-3 text-sm font-semibold text-tauf-ink">{{ $card['label'] }}</p>
                <p class="text-xs text-tauf-gray">{{ $card['total'] }}</p>
            </div>
        @endforeach
    </div>

    {{-- Raccourcis --}}
    <div class="mt-6">
        <h2 class="mb-3 font-display text-lg font-bold text-tauf-ink">Actions rapides</h2>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.posts.create') }}" class="btn-primary !py-2.5 text-xs">+ Nouvel article</a>
            <a href="{{ route('admin.events.create') }}" class="btn-outline-dark !py-2.5 text-xs">+ Nouvel événement</a>
            <a href="{{ route('admin.projects.create') }}" class="btn-outline-dark !py-2.5 text-xs">+ Nouvelle réalisation</a>
            <a href="{{ route('admin.media.create') }}" class="btn-outline-dark !py-2.5 text-xs">+ Téléverser un média</a>
        </div>
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-2">
        {{-- Derniers articles --}}
        <div class="rounded-2xl border border-gray-100 bg-white shadow-sm">
            <div class="flex items-center justify-between border-b border-gray-100 px-5 py-4">
                <h2 class="font-display font-bold text-tauf-ink">Derniers articles</h2>
                <a href="{{ route('admin.posts.index') }}" class="text-xs font-semibold text-tauf-green hover:underline">Tout voir</a>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse ($latestPosts as $post)
                    <a href="{{ route('admin.posts.edit', $post) }}" class="flex items-center gap-3 px-5 py-3 hover:bg-gray-50">
                        <img src="{{ upload_url($post->cover) }}" alt="" class="h-10 w-10 rounded-lg object-cover">
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-semibold text-tauf-ink">{{ $post->title }}</p>
                            <p class="text-xs text-tauf-gray">{{ $post->category->name ?? 'Sans catégorie' }} · {{ $post->created_at->format('d/m/Y') }}</p>
                        </div>
                        <span class="rounded-full px-2 py-0.5 text-[10px] font-bold {{ $post->status === 'publie' ? 'bg-tauf-green-light text-tauf-green' : 'bg-gray-100 text-gray-500' }}">{{ ucfirst($post->status) }}</span>
                    </a>
                @empty
                    <p class="px-5 py-6 text-sm text-tauf-gray">Aucun article pour le moment.</p>
                @endforelse
            </div>
        </div>

        {{-- Derniers messages --}}
        <div class="rounded-2xl border border-gray-100 bg-white shadow-sm">
            <div class="flex items-center justify-between border-b border-gray-100 px-5 py-4">
                <h2 class="font-display font-bold text-tauf-ink">Messages récents</h2>
                <a href="{{ route('admin.messages.index') }}" class="text-xs font-semibold text-tauf-green hover:underline">Tout voir</a>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse ($latestMessages as $message)
                    <a href="{{ route('admin.messages.show', $message) }}" class="flex items-start gap-3 px-5 py-3 hover:bg-gray-50">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-tauf-green-light text-sm font-bold text-tauf-green">{{ strtoupper(substr($message->name, 0, 1)) }}</span>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-semibold text-tauf-ink">{{ $message->name }} @if (! $message->is_read)<span class="ml-1 inline-block h-2 w-2 rounded-full bg-tauf-red"></span>@endif</p>
                            <p class="truncate text-xs text-tauf-gray">{{ $message->subject ?: Str::limit($message->message, 50) }}</p>
                        </div>
                    </a>
                @empty
                    <p class="px-5 py-6 text-sm text-tauf-gray">Aucun message reçu.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
