const theme = require('tailwindcss/defaultTheme')

module.exports = {
    future: {
        // Upcoming changes for TailwindCSS v2
        removeDeprecatedGapUtilities: true,
        purgeLayersByDefault: true,
        defaultLineHeights: true,
        standardFontWeights: true,
    },

    theme: {
        colors: {
            inherit: 'inherit',
            ...theme.colors
        }
    },

    variants: {
        backgroundColor: ({ after }) => after(['hocus', 'focus-within']),
        padding: ({ after }) => after(['first', 'last']),
        textColor: ({ after }) => after(['hocus'])
    },

    purge: {
        content: [
            './storage/framework/views/*.php',
            './resources/**/*.blade.php',

            // Include Component classes from MOPS
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