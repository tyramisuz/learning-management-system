const mix = require('laravel-mix');

mix.postCss('resources/css/app.css', 'public/css', [
  require('tailwindcss'),
  require('autoprefixer'),
])
.js('resources/js/app.js', 'public/js')
.postCss('resources/css/custom.css', 'public/css'); 
