@extends('layouts.admin')

@section('title', 'Messages')
@section('heading', 'Messages de contact')
@section('subheading', 'Consultez les messages reçus via le formulaire de contact')

@section('content')
    <div class="rounded-2xl border border-gray-100 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-gray-100 p-4">
            <div class="flex gap-2">
                <a href="{{ route('admin.messages.index') }}" class="rounded-full px-4 py-2 text-xs font-semibold {{ ! request('filtre') ? 'bg-tauf-green text-white' : 'border border-gray-200 text-tauf-gray' }}">Tous</a>
                <a href="{{ route('admin.messages.index', ['filtre' => 'non_lus']) }}" class="rounded-full px-4 py-2 text-xs font-semibold {{ request('filtre') === 'non_lus' ? 'bg-tauf-green text-white' : 'border border-gray-200 text-tauf-gray' }}">Non lus ({{ $unread }})</a>
            </div>
        </div>
        <div class="divide-y divide-gray-100">
            @forelse ($messages as $message)
                <div class="flex items-start gap-4 p-4 {{ $message->is_read ? '' : 'bg-tauf-green-light/40' }}">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-tauf-green text-sm font-bold text-white">{{ strtoupper(substr($message->name, 0, 1)) }}</span>
                    <div class="min-w-0 flex-1">
                        <p class="flex items-center gap-2 text-sm font-semibold text-tauf-ink">
                            {{ $message->name }}
                            @if (! $message->is_read)<span class="rounded-full bg-tauf-red px-2 py-0.5 text-[10px] font-bold text-white">Nouveau</span>@endif
                        </p>
                        <p class="text-xs text-tauf-gray">{{ $message->email }} @if ($message->phone)· {{ $message->phone }}@endif</p>
                        <p class="mt-1 truncate text-sm text-tauf-gray">{{ $message->subject ?: Str::limit($message->message, 80) }}</p>
                    </div>
                    <div class="flex shrink-0 items-center gap-2">
                        <span class="hidden text-xs text-tauf-gray sm:block">{{ $message->created_at->format('d/m/Y H:i') }}</span>
                        <a href="{{ route('admin.messages.show', $message) }}" class="rounded-lg bg-tauf-green-light px-3 py-1.5 text-xs font-semibold text-tauf-green">Lire</a>
                        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" data-confirm="Supprimer ce message ?">
                            @csrf @method('DELETE')
                            <button class="rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600">Suppr.</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="py-10 text-center text-tauf-gray">Aucun message.</p>
            @endforelse
        </div>
        @if ($messages->hasPages())<div class="border-t border-gray-100 p-4">{{ $messages->links() }}</div>@endif
    </div>
@endsection
