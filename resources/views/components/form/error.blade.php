@props(['name'])

@error($name)
    <div class="mt-2 flex items-center">
        <x-icons.error />
        <p class="text-red-600 font-medium text-sm ml-1">{{ __($message) }}</p>
    </div>
@enderror