<div class="font-normal text-base">
    @if (Config::get('app.locale') == 'en')
        <a href="{{ route('locale.change', 'ka') }}">{{ __('header.georgian') }}</a>
    @else            
        <a href="{{ route('locale.change', 'en') }}">{{ __('header.english') }}</a>
    @endif
</div>