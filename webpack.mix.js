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

//---mix copy
// mix.copy('node_modules/datatables.net-bs/css/dataTables.bootstrap.css', 'resources/assets/sass/dataTables.bootstrap.css');
mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/admin.scss', 'public/css/admin')
    .sass('resources/assets/sass/fonts-awesome/font-awesome.scss', 'public/css/');
    // .sass('resources/assets/sass/fonts-awesome/font-awesome.scss', 'public/css/admin');
    // .sass('resources/assets/sass/dataTables.bootstrap.css', 'public/css/admin');

//---mix cpy
mix.copy('node_modules/sweetalert2/src/sweetalert2.js', 'resources/assets/js/vendors/sweetalert2.js');
// mix.copy('node_modules/datatables.net/js/jquery.dataTables.js', 'resources/assets/js/vendors/jquery.dataTables.js');
// mix.copy('node_modules/datatables.net-bs/js/dataTables.bootstrap.js', 'resources/assets/js/vendors/dataTables.bootstrap.js');
//---js admin
mix.scripts([
    'resources/assets/js/vendors/jquery-ui.js',
    'resources/assets/js/vendors/function-admin.js',
    'resources/assets/js/vendors/sweetalert2.js',
    // 'resources/assets/js/vendors/jquery.dataTables.js',
    // 'resources/assets/js/vendors/dataTables.bootstrap.js',
    'resources/assets/js/vendors/function.js',
], 'public/js/admin/plugins.js');

//---js web

if (mix.config.inProduction) {
    mix.version();
}