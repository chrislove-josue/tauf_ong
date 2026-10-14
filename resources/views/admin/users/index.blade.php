@extends('layouts.admin')

@section('title', 'Utilisateurs')
@section('heading', 'Utilisateurs & droits')
@section('subheading', 'Gérez les comptes administrateurs, éditeurs et contributeurs')

@section('content')
    <div class="rounded-2xl border border-gray-100 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-gray-100 p-4">
            <p class="text-sm text-tauf-gray">{{ $users->total() }} utilisateur(s)</p>
            <a href="{{ route('admin.users.create') }}" class="btn-primary !py-2.5 text-xs">+ Nouvel utilisateur</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-gray-100 bg-gray-50 text-xs uppercase tracking-wider text-tauf-gray">
                    <tr>
                        <th class="px-4 py-3 font-semibold">Utilisateur</th>
                        <th class="px-4 py-3 font-semibold">Rôle</th>
                        <th class="px-4 py-3 font-semibold">Statut</th>
                        <th class="px-4 py-3 font-semibold">Dernière connexion</th>
                        <th class="px-4 py-3 text-right font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <img src="{{ upload_url($user->photo, 'images/placeholder.svg') }}" alt="" class="h-9 w-9 rounded-full object-cover">
                                    <div>
                                        <p class="font-semibold text-tauf-ink">{{ $user->name }} @if ($user->id === auth()->id())<span class="text-xs text-tauf-gray">(vous)</span>@endif</p>
                                        <p class="text-xs text-tauf-gray">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3"><span class="rounded-full bg-tauf-green-light px-2.5 py-1 text-[11px] font-bold text-tauf-green">{{ $user->roleLabel() }}</span></td>
                            <td class="px-4 py-3"><span class="rounded-full px-2.5 py-1 text-[11px] font-bold {{ $user->is_active ? 'bg-tauf-green-light text-tauf-green' : 'bg-red-50 text-red-600' }}">{{ $user->is_active ? 'Actif' : 'Désactivé' }}</span></td>
                            <td class="px-4 py-3 text-xs text-tauf-gray">{{ $user->last_login_at?->format('d/m/Y H:i') ?? '—' }}</td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="rounded-lg bg-tauf-green-light px-3 py-1.5 text-xs font-semibold text-tauf-green">Modifier</a>
                                    @if ($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" data-confirm="Supprimer cet utilisateur ?">
                                            @csrf @method('DELETE')
                                            <button class="rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600">Suppr.</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-10 text-center text-tauf-gray">Aucun utilisateur.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($users->hasPages())<div class="border-t border-gray-100 p-4">{{ $users->links() }}</div>@endif
    </div>
@endsection
