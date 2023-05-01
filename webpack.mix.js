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
    .sass('resources/sass/app.scss', 'public/css')

    .sass('resources/sass/main.scss', 'public/css/codebase.css')
    .sass('resources/sass/codebase/themes/corporate.scss', 'public/css/themes/corporate.css')
    .sass('resources/sass/frontend/main.scss', 'public/css/frontend/main.css')


    .sass('resources/sass/codebase/themes/earth.scss', 'public/css/themes/')
    .sass('resources/sass/codebase/themes/elegance.scss', 'public/css/themes/')
    .sass('resources/sass/codebase/themes/flat.scss', 'public/css/themes/')
    .sass('resources/sass/codebase/themes/pulse.scss', 'public/css/themes/')

    .js('resources/js/codebase/codebase.app.js', '/public/js/codebase.app.js')
    .js('resources/js/ku-modules/input.js', 'public/js/ku-modules/input.js')

    /* Page JS */
    .js('resources/js/pages/tables_datatables.js', 'public/js/pages/tables_datatables.js')
    .js('resources/js/pages/admin_settings.js', 'public/js/pages/admin_settings.js')
    .js('resources/js/pages/user_withdrawal.js', 'public/js/pages/user_withdrawal.js')
    .js('resources/js/codebase/ku-global.js', 'public/js/ku-global.js')
    .version()
    .browserSync('bf.demo')
    .disableNotifications()

    /* Options */
    .options({
        processCssUrls: false
    });

