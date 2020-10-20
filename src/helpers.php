<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

if (!function_exists('in_route')) {
    function in_route(string $route, bool $highlightChildrenRoutes = true): bool
    {
        if ($highlightChildrenRoutes) {
            $route = Str::beforeLast($route, '.');
        }

        return Str::contains(Route::currentRouteName(), $route);
    }
}