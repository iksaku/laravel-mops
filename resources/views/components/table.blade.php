<?php /** @var Illuminate\Contracts\Pagination\LengthAwarePaginator $for */ ?>

@props(['for'])

<div class="w-full -my-2 py-2">
    <div class="w-full flex flex-col bg-white sm:rounded-md border border-gray-300 divide-y divide-gray-200 overflow-y-hidden">
        @isset($actions)
            {{-- Actions are items placed inside the table card, but above the table --}}
            <div class="px-6 py-4">
                {{ $actions }}
            </div>
        @endisset

        @if($for->isEmpty())
            {{-- If empty, look for a slot named "empty", otherwise, use a generic one --}}
            @isset($empty)
                {{ $empty }}
            @else
                <div class="text-center text-gray-500 text-xl px-6 py-3">
                    No se encontraron registros.
                </div>
            @endisset
        @else
            {{-- If not empty, render a table :)--}}
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    {{ $slot }}
                </table>
            </div>

            @if($for->hasPages())
                {{ $for->links() }}
            @endif
        @endif
    </div>
</div>
