<?php

namespace iksaku\Laravel\Mops\Models\Query;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

trait SimpleSearch
{
    /**
     * Inspiration:
     * https://freek.dev/1182-searching-models-using-a-where-like-query-in-laravel.
     *
     * Perform SQL search between one or more columns.
     *
     * If you provide an array of columns, those will be scoped for search.
     *
     * If you need to provide an operator distinct than 'LIKE' for search on a certain column,
     * you may do so by passing the column as a key and the operator as its value,
     *
     * For example:
     *      ['id' => '=', 'title']
     * This means that the 'id' column will be compared with the '=' operator, testing for raw equality,
     * while the 'title' column will use the default 'LIKE' operator.
     *
     * @param Builder $query
     * @param string|string[]|array<string,string> $column
     * @param string $searchTerm
     *
     * @return Builder
     */
    public function scopeSearch(Builder $query, $column, string $searchTerm): Builder
    {
        // If there's no search term, gracefully bail out.
        if (empty($searchTerm)) {
            return $query;
        }

        // Create a scoped 'where' query, so it doesn't interferes with other queries.
        return $query->where(function (Builder $query) use ($column, $searchTerm) {
            // Wrap single column in an array if needed.
            foreach (Arr::wrap($column) as $attribute => $operator) {
                // Try to use a 'column' => 'operator' scheme.
                if (!is_string($attribute)) {
                    // If in this loop run, the 'column' is not a string,
                    // it means its a numeric key index, so no operator was given.
                    // Fix 'column' name and provide the default 'LIKE' operator.
                    $attribute = $operator;
                    $operator = 'LIKE';
                }

                if ($operator === 'LIKE') {
                    // Surround the 'search term' with SQL wildcards (%).
                    $tmpTerm = "%{$searchTerm}%";
                }

                // Append query along with previous queries.
                $query->orWhere($attribute, $operator, $tmpTerm ?? $searchTerm);
            }
        });
    }
}