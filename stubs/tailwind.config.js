module.exports = {
    purge: [],

    darkMode: false,

    presets: [
        require('./vendor/iksaku/laravel-mops/resources/css/presets/laravel'),
        require('./vendor/iksaku/laravel-mops/resources/css/presets/mops'),
    ],

    theme: {
        extend: {},
    },

    variants: {
        extend: {},
    },

    plugins: [
        require('@iksaku/tailwindcss-plugins/src/interFontFamily'),
    ],
}