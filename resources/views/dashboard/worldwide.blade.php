<x-dashboard.layout user="{{ $username }}" heading="{{ __('dashboard.worldwide_statistics') }}">
    <div class="flex flex-wrap gap-4 lg:gap-6">
        <x-dashboard.card class="w-full lg:w-auto bg-blue-700/10">
            <x-icons.charts.new-cases />
            <x-dashboard.name>{{ __('dashboard.new_cases') }}</x-dashboard.name>
            <x-dashboard.result class="text-blue-700">{{ $confirmed ? $confirmed : '-' }}</x-dashboard.result>
        </x-dashboard.card>
        
        <x-dashboard.card class="bg-green-600/10">
            <x-icons.charts.recovered />
            <x-dashboard.name>{{ __('dashboard.recovered') }}</x-dashboard.name>
            <x-dashboard.result class="text-green-600">{{ $recovered ? $recovered : '-' }}</x-dashboard.result>
        </x-dashboard.card>
        
        <x-dashboard.card class="bg-yellow-400/10">
            <x-icons.charts.death />
            <x-dashboard.name>{{ __('dashboard.death') }}</x-dashboard.name>
            <x-dashboard.result class="text-yellow-400">{{ $deaths ? $deaths : '-' }}</x-dashboard.result>
        </x-dashboard.card>
    </div>
</x-dashboard.layout>