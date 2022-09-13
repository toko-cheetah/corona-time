<x-layout>
    <header class="mt-5 flex justify-between items-center">
        <x-logo.coronatime-blue />
        <x-language />
    </header>

    <main class="mt-8">
        <div class="xl:w-screen">
            <h1 class="font-black text-xl mb-2 lg:text-2xl">{{ __('register.welcome_to_coronatime') }}</h1>
            <p class="font-normal text-base text-gray-400 lg:text-xl">{{ __('register.enter_info_to_sign_up') }}</p>
        </div>

        <form action="#" method="post" class="mt-6">
            @csrf

            <x-form.section>
                <x-form.label name="username">{{ __('register.username') }}</x-form.label>
                <x-form.input name="username" type="text" placeholder="{{ __('register.enter_unique_username') }}" />
                <p class="mt-2 text-gray-400 font-normal text-sm">{{ __('register.username_should_be_unique') }}</p>
            </x-form.section>

            <x-form.section>
                <x-form.label name="email">{{ __('register.email') }}</x-form.label>
                <x-form.input name="email" type="email" placeholder="{{ __('register.enter_your_email') }}" />
            </x-form.section>

            <x-form.section>
                <x-form.label name="password">{{ __('register.password') }}</x-form.label>
                <x-form.input name="password" type="password" placeholder="{{ __('register.fill_in_password') }}" />
            </x-form.section>

            <x-form.section>
                <x-form.label name="repeat_password">{{ __('register.repeat_password') }}</x-form.label>
                <x-form.input name="repeat_password" type="password" placeholder="{{ __('register.repeat_password') }}" />
            </x-form.section>

            <x-form.button>{{ __('register.sign_up') }}</x-form.button>
        </form>

        <p class="text-center text-gray-400 font-normal text-sm leading-4 lg:text-base mb-6">
            {{ __('register.already_have_an_account') }}? 
            <a href="#" class="font-bold text-black">{{ __('register.log_in') }}</a>
        </p>
    </main>

    <x-aside />
</x-layout>