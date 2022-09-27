<div {{ $attributes->merge(['class' => 'font-normal text-sm lg:text-base']) }}>
    @if (Config::get('app.locale') == 'en')
        <a href="{{ route('locale.change', 'ka') }}">Georgian</a>
    @else            
        <a href="{{ route('locale.change', 'en') }}">English</a>
    @endif
</div>