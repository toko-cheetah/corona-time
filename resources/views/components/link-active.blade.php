@props(['route'])

<div class="pb-4 mr-6 lg:mr-16 inline-block {{ Route::is($route) ? 'font-bold border-b-4 border-b-black' : '' }}">
    {{ $slot }}
</div>