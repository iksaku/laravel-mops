<?php

namespace iksaku\Laravel\Mops\Http\Livewire\Utilities;

/**
 * @property-read array<string, string> $trashedFilters
 */
trait WithTrashedModelsFilter
{
    public string $trashed = 'withoutTrashed';

    public function initializeWithTrashedModelsFilter(): void
    {
        $this->queryString = array_merge(
            ['trashed' => ['except' => 'withoutTrashed']],
            $this->queryString
        );

        $this->ensureToUseATrashedFilter($this->trashed);
    }

    public function getTrashedFiltersProperty(): array
    {
        return [
            'withTrashed' => trans('mops::livewire.filters.trashed.withTrashed'),
            'withoutTrashed' => trans('mops::livewire.filters.trashed.withoutTrashed'),
            'onlyTrashed' => trans('mops::livewire.filters.trashed.onlyTrashed')
        ];
    }

    public function updatingTrashed(string &$value): void
    {
        // If there's a Paginator running, go back to first page.
        if (isset($this->page)) {
            $this->page = 1;
        }

        $this->ensureToUseATrashedFilter($value);
    }

    protected function ensureToUseATrashedFilter(string &$filter): void
    {
        if (!array_key_exists($filter, $this->trashedFilters)) {
            // Must make sure that this filters are part of a pre-defined group
            // in order to prevent Laravel Query Injections.
            $filter = 'withoutTrashed';
        }
    }
}