@extends('layouts.admin')

@section('title', 'Message')
@section('heading', 'Message de ' . $message->name)

@section('content')
    <div class="mx-auto max-w-3xl">
        <a href="{{ route('admin.messages.index') }}" class="mb-4 inline-flex items-center gap-1 text-sm font-semibold text-tauf-green">← Retour aux messages</a>
        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
            <div class="flex flex-wrap items-start justify-between gap-4 border-b border-gray-100 pb-4">
                <div>
                    <h2 class="font-display text-xl font-bold text-tauf-ink">{{ $message->subject ?: 'Sans objet' }}</h2>
                    <p class="mt-1 text-sm text-tauf-gray">{{ $message->created_at->format('d/m/Y à H:i') }}</p>
                </div>
                <a href="mailto:{{ $message->email }}" class="btn-primary !py-2.5 text-xs">Répondre par e-mail</a>
            </div>

            <dl class="mt-4 grid gap-3 text-sm sm:grid-cols-2">
                <div><dt class="text-tauf-gray">Nom</dt><dd class="font-semibold text-tauf-ink">{{ $message->name }}</dd></div>
                <div><dt class="text-tauf-gray">E-mail</dt><dd class="font-semibold text-tauf-ink">{{ $message->email }}</dd></div>
                @if ($message->phone)<div><dt class="text-tauf-gray">Téléphone</dt><dd class="font-semibold text-tauf-ink">{{ $message->phone }}</dd></div>@endif
                @if ($message->ip_address)<div><dt class="text-tauf-gray">Adresse IP</dt><dd class="text-tauf-ink">{{ $message->ip_address }}</dd></div>@endif
            </dl>

            <div class="mt-6 rounded-2xl bg-gray-50 p-5 text-sm leading-relaxed text-tauf-ink">{!! nl2br(e($message->message)) !!}</div>

            @if ($message->attachment)
                <div class="mt-5">
                    <a href="{{ upload_url($message->attachment) }}" target="_blank" class="inline-flex items-center gap-2 rounded-xl bg-tauf-green-light px-4 py-2.5 text-sm font-semibold text-tauf-green">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21.4 11.05l-9.2 9.2a5 5 0 01-7.07-7.07l9.2-9.2a3 3 0 014.24 4.24l-9.2 9.2a1 1 0 01-1.41-1.41l8.5-8.5"/></svg>
                        Télécharger la pièce jointe
                    </a>
                </div>
            @endif
        </div>

        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" data-confirm="Supprimer ce message ?" class="mt-4">
            @csrf @method('DELETE')
            <button class="rounded-lg bg-red-50 px-4 py-2.5 text-xs font-semibold text-red-600">Supprimer ce message</button>
        </form>
    </div>
@endsection
