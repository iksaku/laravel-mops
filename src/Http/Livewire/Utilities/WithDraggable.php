<?php

namespace iksaku\Laravel\Mops\Http\Livewire\Utilities;

trait WithDraggable
{
    /**
     * This function receives a $dragEvent parameter, which contains the order in which
     * we should sort our items after being dragged in the UI. The actual format is:
     *
     * [
     *      newIndex => [
     *          order => Numerical order, used in case index keys don't preserve order.
     *          value => Reference to the items being dragged. In our case, the "previous index" that the item had.
     *      ]
     * ]
     *
     * With this in mind, we simplify the process by using collection methods and
     * keep the code cleaner and a little more descriptive by itself.
     *
     * @param array $haystack The array holding the draggable items.
     * @param array $dragEvent The event fired by the livewire-sort plugin.
     * @see https://github.com/livewire/sortable
     */
    protected function onDrag(array &$haystack, array $dragEvent): void
    {
        $haystack = collect($dragEvent)
            // Make sure to follow the new order calculated by the sortable plugin.
            ->sortBy('order')
            // Grab the item from the haystack with its old index and assign it to the new index.
            ->map(fn (array $draggedItem) => $haystack[(int) $draggedItem['value']])
            // Finally, convert everything back to an array.
            ->toArray();
    }
}