<?php

namespace iksaku\Laravel\Mops\Models\Query;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

trait JsonUtilities
{
    /**
     * Returns the total count of items inside one or more JSON columns.
     *
     * The way this works is that you provide the name of a JSON column and the resulting query
     * data will include a <column>_count field, containing the item count of the column.
     *
     * You may provide multiple columns as an array, like:
     *      ['phone_numbers', 'preferred_languages']
     * And in your resulting query, you'll get the following fields with their respective count:
     *      ['phone_numbers_count', 'preferred_languages_count']
     *
     * You can also change the alias of the resulting count fields by using an array-value
     * scheme for the column you want to change the alias, like:
     *      ['phone_numbers' => 'available_phones']
     * This will assign the count of the 'phone_numbers' column to a field named 'available_phones'.
     *
     * @param Builder $query
     * @param string|string[]|array<string,string> $column
     * @return Builder
     */
    public function scopeWithJsonCount(Builder $query, $column): Builder
    {
        // Build a JSON Count query for the given columns
        foreach (Arr::wrap($column) as $column => $alias) {
            // Try to use a 'column' => 'alias' scheme.
            if (!is_string($column)) {
                // If in this loop run, the 'column' is not a string,
                // it means its a numeric key index, so no operator was given.
                // Fix 'column' name and use the default '<column>_count' alias.
                $column = $alias;
                $alias = "{$column}_count";
            }

            $query
                // Use MySQL's JSON_LENGTH function and assign it to the given field alias.
                ->selectRaw("JSON_LENGTH({$column}) as $alias")
                // Also, cast the field alias to be an integer, just for the sake of making thins easy
                ->withCasts([
                    $alias => 'integer',
                ]);
        }

        return $query;
    }
}