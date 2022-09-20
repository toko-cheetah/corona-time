<x-box-center>
    <h1 class="font-black text-2xl -mt-12 mb-10">{{ __('reset-password.reset_password') }}</h1>

    <form action="{{ route('password.update') }}" method="post" class="w-full text-left">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <x-form.section>
            <x-form.label name="password">{{ __('reset-password.new_password') }}</x-form.label>
            <x-form.input name="password" type="password" placeholder="{{ __('reset-password.enter_new_password') }}" />
            <x-form.error name="password" />
        </x-form.section>

        <x-form.section>
            <x-form.label name="password_confirmation">{{ __('register.repeat_password') }}</x-form.label>
            <x-form.input name="password_confirmation" type="password" placeholder="{{ __('register.repeat_password') }}" />
            <x-form.error name="password_confirmation" />
        </x-form.section>

        <x-form.button>{{ __('reset-password.save_changes') }}</x-form.button>
    </form>
</x-box-center>