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
    .sass('resources/sass/app.scss', 'public/css')
    // .styles(['node_modules/datatables.net-dt/css/jquery.dataTables.css', 'node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css', 'node_modules/datatables.net-responsive-bs4/css/responsive.bootstrap4.css'], 'public/css/datatables.min.css')
    // .scripts('node_modules/bootstrap/dist/js/bootstrap.bundle.js', 'public/js/bootstrap.bundle.min.js')
    // .scripts('node_modules/jquery/dist/jquery.js', 'public/js/jquery.min.js')
    // .scripts(['node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js', 'node_modules/datatables.net-responsive-bs4/js/responsive.bootstrap4.js', 'node_modules/datatables.net/js/jquery.dataTables.js', 'node_modules/datatables.net-responsive/js/dataTables.responsive.js'], 'public/js/datatables.min.js')
    .scripts('node_modules/@fortawesome/fontawesome-free/js/all.js', 'public/js/fontawesome.min.js')
    .scripts('node_modules/sweetalert2/dist/sweetalert2.all.js', 'public/js/sweetalert2.min.js')
    .copy('node_modules/datatables.net-dt/images', 'public/images')
    .copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts');
