<x-dashboard.layout user="{{ $username }}" heading="{{ __('dashboard.statistics_by_country') }}">
    <form action="{{ route('home.by_country') }}" method="get" class="relative">
        <input 
            class="border rounded-lg border-gray-200 py-4 pl-14 pr-5 font-medium text-sm"
            type="text" 
            name="search"
            value="{{ $searchValue ? $searchValue : '' }}"
            placeholder="Search by country"
        >

        <div class="absolute top-4 left-5">
            <x-icons.search />
        </div>
    </form>

    <table class="relative mt-6 lg:mt-10 text-center w-full shadow-card-shadow">
        <tr class="bg-gray-100 sticky top-0">
            <x-dashboard.table-heading>
                <x-dashboard.sorting-form 
                    sortByValue="country"
                    countClicksKey="{{ $countClicks['country'] }}"
                >
                    {{ __('dashboard.location') }}
                </x-dashboard.sorting-form>
            </x-dashboard.table-heading>

            <x-dashboard.table-heading>
                <x-dashboard.sorting-form 
                    sortByValue="confirmed"
                    countClicksKey="{{ $countClicks['confirmed'] }}"
                >
                    {{ __('dashboard.new_cases') }}
                </x-dashboard.sorting-form>
            </x-dashboard.table-heading>

            <x-dashboard.table-heading>
                <x-dashboard.sorting-form 
                    sortByValue="deaths"
                    countClicksKey="{{ $countClicks['deaths'] }}"
                >
                    {{ __('dashboard.death') }}
                </x-dashboard.sorting-form>
            </x-dashboard.table-heading>

            <x-dashboard.table-heading>
                <x-dashboard.sorting-form 
                    sortByValue="recovered"
                    countClicksKey="{{ $countClicks['recovered'] }}"
                >
                    {{ __('dashboard.recovered') }}
                </x-dashboard.sorting-form>
            </x-dashboard.table-heading>
        </tr>
        
        @if ($covidStatisticsData)                
            @foreach ($covidStatisticsData as $country)
                <tr class="bg-gray-50 border-b border-b-gray-100">
                    <x-dashboard.table-cell>{{ $country->country ? $country->country : '-' }}</x-dashboard.table-cell>
                    <x-dashboard.table-cell>{{ $country->confirmed ? $country->confirmed : '-' }}</x-dashboard.table-cell>
                    <x-dashboard.table-cell>{{ $country->deaths ? $country->deaths : '-' }}</x-dashboard.table-cell>
                    <x-dashboard.table-cell>{{ $country->recovered ? $country->recovered : '-' }}</x-dashboard.table-cell>
                </tr>
            @endforeach
        @endif
    </table>
</x-dashboard.layout>