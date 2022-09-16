<x-layout>
    <x-width-small class="flex flex-col items-center">
        <header>
            <x-logo.coronatime-blue />
        </header>

        <main class="mt-52 flex flex-col items-center text-center font-normal text-base lg:text-lg">
            {{ $slot }}
        </main>
    </x-width-small>
</x-layout>