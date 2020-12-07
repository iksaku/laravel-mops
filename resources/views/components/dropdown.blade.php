<x-mops::include.component.open-close />

<div
    x-data="{ ...mopsComponentOpenClose(), ...{{ $attributes->get('x-data', '{}') }} }"
    @click.away="close()"

    class="relative inline-block"
>
    <div @click="toggle()">
        {{ $trigger }}
    </div>

    <div
        {{
            $attributes->except('x-data')->merge([
                'x-cloak' => '',
                'x-show' => 'isOpen',
                'class' => 'absolute z-20 min-w-full whitespace-nowrap rounded-md shadow-lg mt-2',

                'x-transition:enter' => 'transform duration-100 ease-out',
                'x-transition:enter-start' => 'opacity-0 scale-90',
                'x-transition:enter-end' => 'opacity-100 scale-100',
                'x-transition:leave' => 'transform duration-100 ease-in',
                'x-transition:leave-start' => 'opacity-100 scale-100',
                'x-transition:leave-end' => 'opacity-90 scale-90'
            ])
        }}
    >
        <div class="rounded-md overflow-x-hidden">
            {{ $slot }}
        </div>
    </div>
</div>