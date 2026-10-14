@props([
    'name',
    'label' => null,
    'value' => null,
    'help' => null,
])

<div>
    @if ($label)
        <label class="mb-1.5 block text-sm font-semibold text-tauf-ink">{{ $label }}</label>
    @endif
    <div class="rounded-xl border border-gray-200 bg-white">
        <div data-editor="#{{ $name }}-input"></div>
    </div>
    <textarea name="{{ $name }}" id="{{ $name }}-input" class="hidden">{{ old($name, $value) }}</textarea>
    @if ($help)<p class="mt-1 text-xs text-tauf-gray">{{ $help }}</p>@endif
    @error($name)<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
</div>
