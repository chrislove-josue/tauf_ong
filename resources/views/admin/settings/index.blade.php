@extends('layouts.admin')

@section('title', 'Paramètres')
@section('heading', 'Paramètres du site')
@section('subheading', 'Informations générales, contact, réseaux sociaux et SEO')

@section('content')
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf @method('PUT')
        <div class="space-y-6">
            @foreach ($groups as $groupKey => $group)
                <div class="rounded-2xl border border-gray-100 bg-white shadow-sm">
                    <div class="border-b border-gray-100 px-6 py-4">
                        <h2 class="font-display font-bold text-tauf-ink">{{ $group['label'] }}</h2>
                    </div>
                    <div class="grid gap-5 p-6 sm:grid-cols-2">
                        @foreach ($group['fields'] as $key => $field)
                            <div class="{{ $field['type'] === 'textarea' ? 'sm:col-span-2' : '' }}">
                                @if ($field['type'] === 'textarea')
                                    <label for="s-{{ $key }}" class="mb-1.5 block text-sm font-semibold text-tauf-ink">{{ $field['label'] }}</label>
                                    <textarea name="settings[{{ $key }}]" id="s-{{ $key }}" rows="3" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-tauf-green focus:outline-none focus:ring-1 focus:ring-tauf-green">{{ old('settings.'.$key, $values[$key] ?? '') }}</textarea>
                                @else
                                    <label for="s-{{ $key }}" class="mb-1.5 block text-sm font-semibold text-tauf-ink">{{ $field['label'] }}</label>
                                    <input type="text" name="settings[{{ $key }}]" id="s-{{ $key }}" value="{{ old('settings.'.$key, $values[$key] ?? '') }}" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-tauf-green focus:outline-none focus:ring-1 focus:ring-tauf-green">
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        <div class="sticky bottom-4 mt-6 flex justify-end">
            <button class="btn-primary shadow-lg">Enregistrer les paramètres</button>
        </div>
    </form>
@endsection
