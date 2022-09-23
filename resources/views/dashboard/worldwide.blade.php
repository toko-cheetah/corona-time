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
                
                <div id="menu" class="absolute hidden top-7 -right-3 px-4 lg:px-0 lg:flex lg:static text-end">
                    <p class="mr-4 font-bold mb-2 lg:mb-0 w-full lg:w-auto">{{ $user->username }}</p>

                    <form action="{{ route('logout') }}" method="post" class="text-center lg:border-l lg:border-l-gray-200 lg:pl-4">
                        @csrf
                        <button type="submit">{{ __('dashboard.log_out') }}</button>
                    </form>
                </div>
            </div>
        </header>
        <x-line />

        <main class="mt-12">
            <h1 class="font-black text-xl mb-6 lg:font-extrabold lg:text-2xl lg:mb-10">{{ __('dashboard.worldwide_statistics') }}</h1>

            <div class="border-b border-b-gray-200 lg:text-base">
                <x-link-active route="home">
                    <a href="{{ route('home') }}">{{ __('dashboard.worldwide') }}</a>
                </x-link-active>

                <x-link-active route="#">
                    <a href="#">{{ __('dashboard.by_country') }}</a>
                </x-link-active>
            </div>

            @if ($confirmed && $recovered && $deaths)
                <div class="flex flex-wrap gap-4 lg:gap-6 mt-6 lg:mt-10">
                    <x-dashboard.card class="w-full lg:w-auto bg-blue-700/10">
                        <x-icons.charts.new-cases />
                        <x-dashboard.name>{{ __('dashboard.new_cases') }}</x-dashboard.name>
                        <x-dashboard.result class="text-blue-700">{{ $confirmed }}</x-dashboard.result>
                    </x-dashboard.card>
                    
                    <x-dashboard.card class="bg-green-600/10">
                        <x-icons.charts.recovered />
                        <x-dashboard.name>{{ __('dashboard.recovered') }}</x-dashboard.name>
                        <x-dashboard.result class="text-green-600">{{ $recovered }}</x-dashboard.result>
                    </x-dashboard.card>
                    
                    <x-dashboard.card class="bg-yellow-400/10">
                        <x-icons.charts.death />
                        <x-dashboard.name>{{ __('dashboard.death') }}</x-dashboard.name>
                        <x-dashboard.result class="text-yellow-400">{{ $deaths }}</x-dashboard.result>
                    </x-dashboard.card>
                </div>
            @else
                <div class="text-center">
                    <p>{{ __('dashboard.something_went_wrong') }}</p>
                    <p>{{ __('dashboard.visit_later') }}</p>
                </div>
            @endif
        </main>
    </x-width-small>
</x-layout>