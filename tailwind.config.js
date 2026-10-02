import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './src/**/*.{html,js}',
        './node_modules/flowbite/**/*.js'
    ],

    stats: {
        children: true,
      },

    theme: {
        extend: {
            outline: ['focus'],
            boxShadow: ['focus'],
            float: ['hover'],
            fontFamily: {
                montserrat: ['Montserrat', 'sans-serif'],
                opensans: ['Open Sans', 'sans-serif'],
                roboto: ['Roboto', 'sans-serif'],
            },
            colors: {
                'custom-orange': '#CC3333',
                'custom-teal': '#009688',
                'custom-blue-hover': '#2962ff',
            },
            screens: {
                'sm-custom': { 'max': '704px' },
              },
        },
    },

    plugins: [
        forms,
        require('@tailwindcss/forms'),
        require('flowbite/plugin')({
            charts: true,
        }),
    ],
};
