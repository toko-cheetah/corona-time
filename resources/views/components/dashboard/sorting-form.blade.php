@props(['sortByValue', 'ascendingKey'])

<form action="{{ route('home.by_country') }}" method="get">
    <input type="text" name="sortBy" value="{{ $sortByValue }}" hidden>

    <input type="number" name="ascending" value="{{ $ascendingKey >= 1 ? $ascendingKey + 1 : ($ascendingKey ? 0 : 1) }}" hidden>
    
    <button type="submit" class="flex m-auto justify-center items-center gap-1">
        {{ $slot }}

        @if ($ascendingKey == 0)
            <x-icons.sort />
        @elseif ($ascendingKey % 2 !== 0)
            <x-icons.sort-up />
        @else
            <x-icons.sort-down />
        @endif
    </button>
</form>