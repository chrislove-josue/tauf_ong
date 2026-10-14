@props([
    'name',
    'label' => null,
    'options' => [],
    'value' => null,
    'required' => false,
    'placeholder' => null,
    'help' => null,
])

@php
    $selected = old($name, $value);
    if ($selected instanceof \BackedEnum) $selected = $selected->value;
    if ($selected instanceof \UnitEnum) $selected = $selected->name;
@endphp

<div>
    @if ($label)
        <label for="{{ $name }}" class="mb-1.5 block text-sm font-semibold text-tauf-ink">
            {{ $label }} @if ($required)<span class="text-tauf-red">*</span>@endif
        </label>
    @endif
    <select
        name="{{ $name }}"
        id="{{ $name }}"
        @if ($required) required @endif
        {{ $attributes->merge(['class' => 'w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm focus:border-tauf-green focus:outline-none focus:ring-1 focus:ring-tauf-green']) }}>
        @if ($placeholder)<option value="">{{ $placeholder }}</option>@endif
        @foreach ($options as $optValue => $optLabel)
            <option value="{{ $optValue }}" @selected((string) $selected === (string) $optValue)>{{ $optLabel }}</option>
        @endforeach
    </select>
    @if ($help)<p class="mt-1 text-xs text-tauf-gray">{{ $help }}</p>@endif
    @error($name)<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
</div>
