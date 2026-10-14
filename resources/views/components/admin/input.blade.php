@props([
    'name',
    'label' => null,
    'type' => 'text',
    'value' => null,
    'required' => false,
    'placeholder' => '',
    'help' => null,
])

<div>
    @if ($label)
        <label for="{{ $name }}" class="mb-1.5 block text-sm font-semibold text-tauf-ink">
            {{ $label }} @if ($required)<span class="text-tauf-red">*</span>@endif
        </label>
    @endif
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        @if ($required) required @endif
        {{ $attributes->merge(['class' => 'w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm focus:border-tauf-green focus:outline-none focus:ring-1 focus:ring-tauf-green']) }}>
    @if ($help)<p class="mt-1 text-xs text-tauf-gray">{{ $help }}</p>@endif
    @error($name)<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
</div>
