import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },

            colors: {
                // adminを変更する
                "admin-main-color": "#0068B6",
                "user-main-color": "#02ADB0",
                "admin-sub-color": "#87BCE3",
                "user-sub-color": "#89DEE0",
                "admin-sub-color-lighter": "#E7F1FA",
                "user-sub-color-lighter": "#DAEFE9",
                "my-accent-color": "#F55854",
                "my-accent-color-lighter": "#FFA2A2",
                "my-text-color": "#555555"
            },
        },
    },

    plugins: [forms],
};
