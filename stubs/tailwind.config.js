module.exports = {
    future: {
        // Upcoming changes for TailwindCSS v2
        removeDeprecatedGapUtilities: true,
        purgeLayersByDefault: true,
        defaultLineHeights: true,
        standardFontWeights: true,
    },

    purge: [],

    presets: [
        require('./vendor/iksaku/laravel-mops/resources/css/presets/laravel'),
        require('./vendor/iksaku/laravel-mops/resources/css/presets/mops'),
    ],

    theme: {
        extend: {}
    },

    variants: {},

    plugins: [
        require('@iksaku/tailwindcss-plugins/src/interFontFamily'),
    ],
}