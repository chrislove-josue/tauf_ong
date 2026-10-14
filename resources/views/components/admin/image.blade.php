@props([
    'name',
    'label' => null,
    'value' => null,
    'help' => null,
    'preview' => true,
])

<div>
    @if ($label)
        <label for="{{ $name }}" class="mb-1.5 block text-sm font-semibold text-tauf-ink">{{ $label }}</label>
    @endif
    <div class="flex items-center gap-4">
        @if ($preview)
            <img id="{{ $name }}-preview" src="{{ upload_url($value) }}" alt="" class="h-16 w-16 shrink-0 rounded-xl border border-gray-200 object-cover">
        @endif
        <input
            type="file"
            name="{{ $name }}"
            id="{{ $name }}"
            accept="image/*"
            data-image-input="#{{ $name }}-preview"
            {{ $attributes->merge(['class' => 'w-full rounded-xl border border-gray-200 bg-white px-3 py-2 text-sm file:mr-3 file:rounded-full file:border-0 file:bg-tauf-green-light file:px-4 file:py-1.5 file:text-tauf-green']) }}>
    </div>
    @if ($help)<p class="mt-1 text-xs text-tauf-gray">{{ $help }}</p>@endif
    @error($name)<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
</div>
