<x-layout>
    <div class="flex flex-col items-center">
        <header>
            <x-logo.coronatime-blue />
        </header>

        <main class="mt-52 flex flex-col items-center">
            <x-icons.checked />
            <p class="my-4">{{ __('register.we_sent_confirmation_email') }}</p>
            
            <form action="{{ route('verification.send') }}" method="post" class="w-full">
                @csrf
                <x-form.button>{{ __('register.resend') }}</x-form.button>
            </form>
        </main>
    </div>
</x-layout>