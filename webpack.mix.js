const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

mix.copy('node_modules/select2', 'public/assets/plugins/select2');
mix.copy('node_modules/vue-the-mask/', 'resources/js/components/v-mask');
mix.copy('node_modules/sweetalert', 'public/assets/plugins/sweetalert');
mix.copy('node_modules/izitoast', 'public/assets/plugins/izitoast');
