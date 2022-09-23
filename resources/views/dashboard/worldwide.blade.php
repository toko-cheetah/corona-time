<x-layout>
    <x-width-small class="lg:w-full font-normal text-sm">
        <header class="flex justify-between items-center lg:text-base">
            <x-logo.coronatime-green />
            
            <div class="flex items-center relative">
                <x-language class="mr-5" />
                
                <div onclick="document.querySelector('#menu').classList.toggle('hidden')" class="lg:hidden">
                    <x-icons.menu />
                </div>
                
                <div id="menu" class="absolute hidden top-9 -right-3 px-4 lg:px-0 lg:block lg:static bg-white">
                    <form action="{{ route('logout') }}" method="post" class="text-center lg:border-l lg:border-l-gray-200 lg:pl-4">
                        @csrf
                        <button type="submit">{{ __('dashboard.log_out') }}</button>
                    </form>
                </div>
            </div>
        </header>

        <x-line />
    </x-width-small>
</x-layout>