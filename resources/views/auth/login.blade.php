<x-auth 
    heading="{{ __('login.welcome_back') }}"
    subheading="{{ __('login.please_enter_your_details') }}"
    bottomText="{{ __('login.dont_have_an_account') }}"
    route="{{ route('register.page') }}"
    link="{{ __('login.sign_up_for_free') }}"
>
    <form action="{{ "#" }}" method="post" class="mt-6">
        @csrf

        <x-form.section>
            <x-form.label name="username">{{ __('login.username_or_email') }}</x-form.label>
            <x-form.input name="username" type="text" placeholder="{{ __('login.enter_username_or_email') }}" />
            <x-form.error name="username" />
        </x-form.section>

        <x-form.section>
            <x-form.label name="password">{{ __('register.password') }}</x-form.label>
            <x-form.input name="password" type="password" placeholder="{{ __('register.fill_in_password') }}" />
            <x-form.error name="password" />
        </x-form.section>

        <div class="mb-4 flex justify-between font-semibold text-sm lg:text-base">
            <div>
                <x-form.input-checkbox name="remember" value="1" />
                <x-form.label name='remember'>{{ __('login.remember_this_device') }}</x-form.label>
            </div>
    
            <a href="{{ route('password.request') }}" class="text-right text-blue-800">{{ __('login.forgot_password') }}?</a>
        </div>

        <x-form.button>{{ __('login.log_in') }}</x-form.button>
    </form>
</x-auth>