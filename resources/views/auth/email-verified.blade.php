<x-box-center>
    <x-icons.checked />
    <p class="my-4">{{ __('register.your_account_is_confirmed') }}</p>
    
    <form action="{{ route('logout') }}" method="post" class="w-full">
        @csrf
        <x-form.button>{{ __('register.log_in') }}</x-form.button>
    </form>
</x-box-center>