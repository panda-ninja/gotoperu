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
// mix.copy('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css', 'resources/assets/sass/dataTables.bootstrap4.css');
// mix.copy('node_modules/sweetalert2/dist/sweetalert2.css', 'resources/assets/sass/sweetalert2.css');
mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/admin.scss', 'public/css/admin')
    .sass('resources/assets/sass/fonts-awesome/font-awesome.scss', 'public/css/')
    .sass('resources/assets/sass/quotes-pdf.css', 'public/css/')
    .sass('vendor/clockpicker-gh-pages/dist/bootstrap-clockpicker.css', 'public/css/')
    // .sass('resources/assets/sass/jquery-ui.css', 'public/css/')

    // .sass('resources/assets/sass/sweetalert2.css', 'public/css/admin');
// mix.sass('resources/assets/sass/jquery_ui.css', 'public/css/jquery.css');
//---mix cpy
mix.copy('vendor/jeroennoten/laravel-ckeditor/resources/assets/ckeditor.js', 'resources/assets/js/vendors/ckeditor.js');
mix.copy('vendor/clockpicker-gh-pages/dist/bootstrap-clockpicker.js', 'resources/assets/js/vendors/bootstrap-clockpicker.js');
// mix.copy('node_modules/datatables.net/js/jquery.dataTables.js', 'resources/assets/js/vendors/jquery.dataTables.js');
// mix.copy('node_modules/datatables.net-bs/js/dataTables.bootstrap.js', 'resources/assets/js/vendors/dataTables.bootstrap.js');
//---js admin
mix.scripts([
    // 'node_modules/jquery/dist/jquery-ui.js',
    'resources/assets/js/vendors/jquery-ui.js',
    'node_modules/jquery-ui/external/requirejs/require.js',
    'resources/assets/js/vendors/owl.carousel.js',
    //Customized
    'resources/assets/js/vendors/function-admin.js',
    'resources/assets/js/vendors/jquery-sortable.js',
    // 'resources/assets/js/vendors/sweetalert2.js',
    // 'resources/assets/js/vendors/jquery.dataTables.js',
    // 'resources/assets/js/vendors/dataTables.bootstrap.js',
    'resources/assets/js/vendors/function.js',
], 'public/js/admin/plugins.js');
mix.scripts([
    'resources/assets/js/vendors/ckeditor.js',
], 'public/js/admin/ckeditor.js');
mix.scripts([
    'resources/assets/js/vendors/bootstrap-clockpicker.js',
], 'public/js/admin/bootstrap-clockpicker.js');
//---js web

if (mix.config.inProduction) {
    mix.version();
}