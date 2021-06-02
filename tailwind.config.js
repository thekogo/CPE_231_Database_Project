const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'bluen': '#1f86c7',
                'yellown': '#ffd36c',
                'pinkn': '#fd808a',
                'blueln': '#c6e5f4',
                'purplen': '#4b365f',
                'lightpurple':'#9b59ea',
                'sky': '#1f86c7',
                'skyn':'#40a9eb',
                'pinkk':'#fc8e87'

            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
