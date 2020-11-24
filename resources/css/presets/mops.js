const colors = require('tailwindcss/colors')

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
            transparent: 'transparent',
            current: 'currentColor',

            black: colors.black,
            white: colors.white,
            gray: colors.coolGray,
            red: colors.red,
            yellow: colors.amber,
            green: colors.emerald,
            blue: colors.blue,
            indigo: colors.indigo,
            purple: colors.violet,
            pink: colors.pink,
        }
    },

    variants: {
        extend: {
            backgroundColor: ['hocus', 'focus-within'],
            padding: ['first', 'last'],
            textColor: ['hocus'],
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@iksaku/tailwindcss-plugins/src/hocus'),
        require('@iksaku/tailwindcss-plugins/src/smoothScroll')
    ]
}