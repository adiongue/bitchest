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

mix.js('resources/js/app.js', 'public/js').vue()
    .js('node_modules/popper.js/dist/popper.js', 'public/js').sourceMaps()// Fix: Erreur dans les liens source : Error: JSON.parse: unexpected character at line 1 column 1 of the JSON data URL de la ressource : http://127.0.0.1:8000/js/app.js URL du lien source : popper.js.map
    .sass('resources/sass/app.scss', 'public/css')
    .copy('resources/assets', 'public/assets');
    mix.options({
        extractStyles: 'public/css/vue-style.css'
    });
      
    // mix.webpackConfig({
    //     resolve: {
    //         alias: {
    //             'vue$': 'vue/dist/vue.runtime.esm.js'
    //         }
    //     },
    // });