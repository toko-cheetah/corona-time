<x-layout>
    <div class="flex flex-col items-center">
        <header>
            <x-logo.coronatime-blue />
        </header>

        <main class="mt-52 flex flex-col items-center">
            <x-icons.checked />
            <p class="my-4">{{ __('register.your_account_is_confirmed') }}</p>
            
            <x-link-button route="#">{{ __('register.log_in') }}</x-link-button>
        </main>
    </div>
</x-layout>