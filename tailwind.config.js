const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
            sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                Ubuntu: ['Ubuntu', 'Jomolhari', ...defaultTheme.fontFamily.sans],
                dz: ['Jomolhari', 'times', ...defaultTheme.fontFamily.sans],
                Aleo: ['Aleo'],
                Roboto: ['Roboto', 'sans-serif'],
                },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
