let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 | We will also be extracting our framework/vendor dependencies into a
 | specific Webpack manifest and vendor file to reduce the size of our app.js file.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
    .extract([
        'vue',
        'axios',
        '@fortawesome/fontawesome-free',
        'popper.js',
        'jquery',
        'metaphor-theme/node_modules/bootstrap/dist/js/bootstrap.min.js',
        'metaphor-theme/dist/js/datepicker/datepicker.js'
    ])
    .sass('resources/assets/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false
    }); // we are not processing the CSS urls due to how the SCSS for Font Awesome works

// copy the webfonts for Font Awesome
mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts');
