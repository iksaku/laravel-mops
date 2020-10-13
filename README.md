# Laravel MOPS
This is My Opinionated Scaffolding for Laravel, based on the [TALL Preset](https://github.com/laravel-frontend-presets/tall),
and heavily inspired by [Laravel Jetstream](https://github.com/laravel/jetstream), but with some tweaking for my
own needs.

## What's in the box?
This package will publish my personal Laravel scaffolding and components in your project.
This scaffolding will include many UI components that I regularly use, as well as publish
the HTTP Components that I regularly use in my projects.

We're using the all mighty [TALL Stack](https://tallstack.dev/), so expect the following:
 - TailwindCSS
 - AlpineJS
 - Livewire

So yeah, if you're not into one of these things, then don't bother using it. It's that simple.

Oh, by the way, you may find in this package some PHP traits or functions that I also use regularly in my projects.
If you like them, you're allowed to use them, just try to give me (or the original author) some credit
wherever you repost.

## Disclaimer
This is for my personal use, but by being Open Source, I intend for other people with close opinions to mine
to use it, whichever way they want. I'm open contributions _if I like what I see_. 

By no means I'll feel obligated to make adjustments outside the scope of my own opinions.

If you don't like what you see, you're free to create another scaffolding based on this, but with your own
tweaking and opinions (just as I did with this repo :wink:).

## Installation
Simply run the following commands:
```sh
composer require livewire/livewire iksaku/laravel-mops
php artisan mops:install
yarn install
```

This will install all required NPM packages and publish my UI and Component scaffolding in your Laravel Application.

Beware that overrides may occur if you're not in a fresh Laravel installation.

