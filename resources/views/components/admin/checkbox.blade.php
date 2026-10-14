@props([
    'name',
    'label' => null,
    'checked' => false,
    'value' => 1,
    'help' => null,
])

<label class="flex cursor-pointer items-center gap-3">
    <input type="hidden" name="{{ $name }}" value="0">
    <input type="checkbox" name="{{ $name }}" value="{{ $value }}" @checked(old($name, $checked)) class="h-5 w-5 rounded border-gray-300 text-tauf-green focus:ring-tauf-green">
    <span class="text-sm font-medium text-tauf-ink">{{ $label }}</span>
    @if ($help)<span class="text-xs text-tauf-gray">{{ $help }}</span>@endif
</label>
