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
    .scripts([
        'node_modules/admin-lte/plugins/toastr/toastr.min.js',
        'node_modules/admin-lte/plugins/sweetalert2/sweetalert2.all.js',
        'node_modules/admin-lte/plugins/moment/moment.min.js',
        'node_modules/admin-lte/plugins/select2/js/select2.full.js',
        'node_modules/admin-lte/plugins/select2/js/i18n/pt-BR.js',
        'node_modules/admin-lte/plugins/datatables/jquery.dataTables.js',
        'node_modules/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.js',
        'node_modules/admin-lte/plugins/datatables-responsive/js/dataTables.responsive.js',
        'node_modules/admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.js',
        'node_modules/admin-lte/plugins/bs-custom-file-input/bs-custom-file-input.js',
        'node_modules/admin-lte/plugins/inputmask/jquery.inputmask.js',
        'node_modules/admin-lte/plugins/summernote/summernote-bs4.js',
        'node_modules/admin-lte/plugins/summernote/lang/summernote-pt-BR.js'
    ], 'public/js/plugins.js')
    .scripts([
        'resources/js/custom.js'
    ], 'public/js/custom.js');

mix.version();
