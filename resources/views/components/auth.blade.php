@props(['heading', 'subheading', 'bottomText', 'route', 'link'])

<x-layout>
    <x-width-small class="lg:m-0">
        <header class="flex justify-between items-center">
            <x-logo.coronatime-blue />
            <x-language />
        </header>

        <main class="mt-8">
            <div class="xl:w-screen-3/4">
                <h1 class="font-black text-xl mb-2 lg:text-2xl">{{ $heading }}</h1>
                <p class="font-normal text-base text-gray-400 lg:text-xl">{{ $subheading }}</p>
            </div>

            {{ $slot }}

            <p class="text-center text-gray-400 font-normal text-sm leading-4 lg:text-base mb-6">
                {{ $bottomText }}? 
                <a href="{{ $route }}" class="font-bold text-black">{{ $link }}</a>
            </p>
        </main>

        <x-aside />
    </x-width-small>
</x-layout>