<?php

namespace iksaku\Laravel\Mops\Http\Livewire\Utilities;

trait WithTrashedModelsFilter
{
    public string $trashed = 'withoutTrashed';

    // TODO: Translations
    public array $trashedFilters = [
        'withTrashed' => 'Include Trashed Items',
        'withoutTrashed' => 'Exclude Trashed Items',
        'onlyTrashed' => 'Show Trashed Items Only'
    ];

    public function initializeWithTrashedModelsFilter(): void
    {
        $this->queryString = array_merge(
            ['trashed' => ['except' => 'withoutTrashed']],
            $this->queryString
        );

        $this->ensureToUseATrashedFilter($this->trashed);
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