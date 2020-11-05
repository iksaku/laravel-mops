const { colors } = require('tailwindcss/defaultTheme')

module.exports = {
    purge: {
        content: [
            // Include Component classes from MOPS
            './vendor/iksaku/laravel-mops/src/View/**/*.php',
            './vendor/iksaku/laravel-mops/**/*.blade.php'
        ]
    },

    theme: {
        colors: {
            inherit: 'inherit',
            ...colors
        }
    },

    variants: {
        backgroundColor: ({ after }) => after(['hocus', 'focus-within']),
        padding: ({ after }) => after(['first', 'last']),
        textColor: ({ after }) => after(['hocus'])
    },

    plugins: [
        require('@tailwindcss/ui'),
        require('@iksaku/tailwindcss-plugins/src/hocus'),
        require('@iksaku/tailwindcss-plugins/src/smoothScroll'),
    ]
}