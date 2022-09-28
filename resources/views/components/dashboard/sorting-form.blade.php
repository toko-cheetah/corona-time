@props(['sortByValue', 'countClicksKey'])

<form action="{{ route('home.by_country') }}" method="get">
    <input type="text" name="sortBy" value="{{ $sortByValue }}" hidden>

    <input type="number" name="countClicks" value="{{ $countClicksKey >= 1 ? $countClicksKey + 1 : ($countClicksKey ? 0 : 1) }}" hidden>
    
    <button type="submit" class="flex m-auto justify-center items-center gap-1">
        {{ $slot }}

        @if ($countClicksKey == 0)
            <x-icons.sort />
        @elseif ($countClicksKey % 2 !== 0)
            <x-icons.sort-up />
        @else
            <x-icons.sort-down />
        @endif
    </button>
</form>