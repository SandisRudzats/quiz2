const mix = require('laravel-mix');

mix
    .js('resources/js/app.js', 'public2/assets/scripts.js')
    .sass('resources/styles/main.sass', 'public2/assets/style.css');