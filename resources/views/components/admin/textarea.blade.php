@props([
    'name',
    'label' => null,
    'value' => null,
    'required' => false,
    'rows' => 5,
    'help' => null,
])

<div>
    @if ($label)
        <label for="{{ $name }}" class="mb-1.5 block text-sm font-semibold text-tauf-ink">
            {{ $label }} @if ($required)<span class="text-tauf-red">*</span>@endif
        </label>
    @endif
    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows }}"
        @if ($required) required @endif
        {{ $attributes->merge(['class' => 'w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm focus:border-tauf-green focus:outline-none focus:ring-1 focus:ring-tauf-green']) }}>{{ old($name, $value) }}</textarea>
    @if ($help)<p class="mt-1 text-xs text-tauf-gray">{{ $help }}</p>@endif
    @error($name)<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
</div>
