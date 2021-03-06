const colors = require('tailwindcss/colors')

module.exports = {
    purge: {
        content: [
            // Include Component classes from MOPS
            './vendor/iksaku/laravel-mops/src/View/**/*.php',
            './vendor/iksaku/laravel-mops/**/*.blade.php'
        ]
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