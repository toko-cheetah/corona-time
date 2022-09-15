@props(['name', 'value'])

<input 
    class="w-5 h-5 align-middle"
    name="{{ $name }}"
    id="{{ $name }}"
    type="checkbox"
    value="{{ $value }}"
/>