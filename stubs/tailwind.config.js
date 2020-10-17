const variants = require('tailwindcss/defaultConfig').variants;

module.exports = {
    future: {
        // Upcoming changes for TailwindCSS v2
        removeDeprecatedGapUtilities: true,
        purgeLayersByDefault: true,
        defaultLineHeights: true,
        standardFontWeights: true,
    },

    theme: {},

    variants: {
        padding: [...variants.padding, 'first', 'last'],
        textColor: [...variants.textColor, 'hocus']
    },

    purge: {
        content: [
            './storage/framework/views/*.php',
            './resources/**/*.blade.php',

            // Mops Stuff
            './vendor/iksaku/laravel-mops/src/View/**/*.php',
            './vendor/iksaku/laravel-mops/**/*.blade.php'
        ],
    },

    plugins: [
        require('@tailwindcss/ui'),
        require('@iksaku/tailwindcss-plugins/src/interFontFamily'),
        require('@iksaku/tailwindcss-plugins/src/hocus'),
        require('@iksaku/tailwindcss-plugins/src/smoothScroll'),
    ],
}