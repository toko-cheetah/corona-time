<x-box-center>
    <x-icons.checked />
    <p class="my-4">{{ __('reset-password.password_updated_successfully') }}</p>
    
    <x-link-button route="{{ route('login') }}">{{ __('register.log_in') }}</x-link-button>
</x-box-center>