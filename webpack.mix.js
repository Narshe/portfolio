const { mix } = require('laravel-mix');


let prodConfig = {

}

let devConfig = {
    watch: true
}
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


let config = process.env.NODE_ENV === 'development' ? devConfig : prodConfig;


mix.webpackConfig(config);
mix.js('resources/assets/js/app.js', 'public/js')
   .js('resources/assets/js/admin.js', 'public/js')
   .sass('resources/assets/sass/admin.scss', 'public/css')
   .sass('resources/assets/sass/app.scss', 'public/css');
