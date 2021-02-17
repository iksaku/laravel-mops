const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    purge: [],

    darkMode: false,

    presets: [
        require('./vendor/iksaku/laravel-mops/resources/css/presets/laravel'),
        require('./vendor/iksaku/laravel-mops/resources/css/presets/mops'),
    ],

    theme: {
        colors: {
            inherit: 'inherit',
            ...defaultTheme.colors
        },

        extend: {},
    },

    variants: {
        extend: {},
    },

    plugins: [
        require('@iksaku/tailwindcss-plugins/src/interFontFamily'),
    ],
}