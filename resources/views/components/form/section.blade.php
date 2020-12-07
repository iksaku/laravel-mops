@props(['title', 'description' => null, 'centeredTitle' => false])

<div
    {{ $attributes->merge(['class' => 'relative w-full flex flex-col md:flex-row items-start md:space-x-4 space-y-4 md:space-y-0 py-4 first:pt-0 last:pb-0']) }}
>
    <div class="md:sticky inset-x-0 top-0 w-full md:w-1/3 flex-shrink-0 text-center md:text-left space-y-2">
        <div class="text-lg font-medium">
            {{ $title }}
        </div>
        @isset($description)
            <div>
                {{ $description }}
            </div>
        @endisset
    </div>

    <div class="w-full flex-grow">
        <x-mops::card>
            {{ $slot }}
        </x-mops::card>
    </div>
</div>
