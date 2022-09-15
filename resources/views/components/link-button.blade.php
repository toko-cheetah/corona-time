@props(['route'])

<a 
    class="mt-2 mb-6 p-4 bg-green-500 text-white uppercase font-black text-sm text-center w-full rounded-lg lg:text-base"
    href="{{ $route }}"
>
    {{ $slot }}
</a>