var elixir = require('laravel-elixir');

var paths = {
 'bootstrap': './public/bower_components/bootstrap-sass/assets/',
 'jquery': './public/bower_components/jquery/'
};

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
 mix.sass('app.scss', 'public/css/',
   {
    includePaths: [
     paths.bootstrap + 'stylesheets/'
    ]
   })
   .copy(paths.bootstrap + 'fonts/bootstrap/**', 'public/fonts')
   .scripts([
    paths.jquery + "dist/jquery.js",
    paths.bootstrap + "javascripts/bootstrap.js",
    './resources/assets/js/**/*.js'
   ], 'public/js/app.js', './')
   .version(['css/app.css', 'js/app.js']);
});
