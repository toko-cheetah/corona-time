<x-box-center>
    <h1 class="font-black text-2xl -mt-12 mb-10">{{ __('reset-password.reset_password') }}</h1>
    
    <form action="{{ route('password.send') }}" method="post" class="w-full text-left">
        @csrf
        
        <x-form.section>
            <x-form.label name="email">{{ __('register.email') }}</x-form.label>
            <x-form.input name="email" type="email" placeholder="{{ __('register.enter_your_email') }}" />
            <x-form.error name="email" />
        </x-form.section>
        
        <x-form.button>{{ __('reset-password.reset_password') }}</x-form.button>
    </form>
</x-box-center>