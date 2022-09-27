@props(['user', 'heading'])

<x-layout>
    <x-width-small class="lg:w-full font-normal text-sm">
        <header class="flex justify-between items-center lg:text-base">
            @if (Route::is('home'))
                <x-logo.coronatime-green />
            @else
                <x-logo.coronatime-blue />
            @endif
            
            <div class="flex items-center relative">
                <x-language class="mr-5 lg:mr-10" />
                
                <div onclick="document.querySelector('#menu').classList.toggle('hidden')" class="lg:hidden">
                    <x-icons.menu />
                </div>
                
                <div id="menu" class="absolute hidden top-7 -right-3 px-4 lg:px-0 lg:flex lg:static text-end w-screen-3/4 max-w lg:w-auto">
                    <p class="mr-4 font-bold mb-2 lg:mb-0 w-full lg:w-auto">{{ $user }}</p>

                    <form action="{{ route('logout') }}" method="post" class="lg:border-l lg:border-l-gray-200 lg:pl-4">
                        @csrf
                        <button type="submit">{{ __('dashboard.log_out') }}</button>
                    </form>
                </div>
            </div>
        </header>
        <x-line />

        <main class="mt-12">
            <h1 class="font-black text-xl mb-6 lg:font-extrabold lg:text-2xl lg:mb-10">{{ __($heading) }}</h1>

            <div class="border-b border-b-gray-200 lg:text-base mb-6 lg:mb-10">
                <x-link-active route="home">
                    <a href="{{ route('home') }}">{{ __('dashboard.worldwide') }}</a>
                </x-link-active>

                <x-link-active route="home.by_country">
                    <a href="{{ route('home.by_country') }}">{{ __('dashboard.by_country') }}</a>
                </x-link-active>
            </div>

            {{ $slot }}
        </main>
    </x-width-small>
</x-layout>