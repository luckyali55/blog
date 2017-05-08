const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */



mix.styles([
    'resources/vendor/bootstrap/css/bootstrap.min.css',
    'resources/vendor/metisMenu/metisMenu.min.css',
    'resources/vendor/font-awesome/css/font-awesome.min.css',
], 'public/css/app.css');

mix.styles([
    'resources/assets/css/style.css',
], 'public/css/style.css');


mix.styles([
    'resources/vendor/jquery/jquery.min.js',
    'resources/vendor/bootstrap/js/bootstrap.min.js',
    'resources/vendor/metisMenu/metisMenu.min.js',
    'resources/assets/js/app.js',
], 'public/js/app.js');





/* front end mix */


mix.styles([
    'resources/vendor/bootstrap/css/bootstrap.min.css',
], 'public/front/css/app.css');

mix.styles([
    'resources/assets/front/css/style.css',
    'resources/assets/front/css/style.css',
], 'public/front/css/style.css');


mix.styles([
    'resources/vendor/jquery/jquery.min.js',
    'resources/vendor/bootstrap/js/bootstrap.min.js',
    'resources/assets/front/js/app.js',
], 'public/front/js/app.js');

