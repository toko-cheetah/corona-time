@props(['name'])

<label
    class="font-bold text-sm mb-2 lg:text-base"
    for="{{ $name }}"
>
    {{ $slot }}
</label>