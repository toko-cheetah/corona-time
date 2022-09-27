<x-dashboard.layout user="{{ $username }}" heading="{{ __('dashboard.statistics_by_country') }}">
    <p>Search by country</p>

    <table class="relative mt-6 lg:mt-10 text-center w-full shadow-card-shadow">
        <tr class="bg-gray-100 sticky top-0">
            <x-dashboard.table-heading>
                <x-dashboard.sorting-form 
                    sortByValue="country"
                    ascendingKey="{{ $ascending['country'] }}"
                >
                    {{ __('dashboard.location') }}
                </x-dashboard.sorting-form>
            </x-dashboard.table-heading>

            <x-dashboard.table-heading>
                <x-dashboard.sorting-form 
                    sortByValue="confirmed"
                    ascendingKey="{{ $ascending['confirmed'] }}"
                >
                    {{ __('dashboard.new_cases') }}
                </x-dashboard.sorting-form>
            </x-dashboard.table-heading>

            <x-dashboard.table-heading>
                <x-dashboard.sorting-form 
                    sortByValue="deaths"
                    ascendingKey="{{ $ascending['deaths'] }}"
                >
                    {{ __('dashboard.death') }}
                </x-dashboard.sorting-form>
            </x-dashboard.table-heading>

            <x-dashboard.table-heading>
                <x-dashboard.sorting-form 
                    sortByValue="recovered"
                    ascendingKey="{{ $ascending['recovered'] }}"
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