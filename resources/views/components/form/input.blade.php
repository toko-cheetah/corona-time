@props(['name', 'type', 'placeholder'])

<input
    class="border rounded-lg border-gray-200 py-4 pl-6 font-normal text-base"
    name="{{ $name }}"
    id="{{ $name }}"
    type="{{ $type }}"
    placeholder="{{ $placeholder }}"
    {{ $attributes(['value' => old($name)]) }}
/>