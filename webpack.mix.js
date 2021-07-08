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
    .js([
        'resources/js/flex.js',
        'resources/js/menu/module.js',
        'resources/js/menu/store-cmd.js',
        'resources/js/menu/store-query.js',
	    'resources/js/menu-items/module.js',
        'resources/js/menu-items/store-cmd.js',
        'resources/js/menu-items/store-query.js',
	    'resources/js/page/module.js',
        'resources/js/page/store-cmd.js',
        'resources/js/page/store-query.js',
	    'resources/js/page-category/module.js',
        'resources/js/page-category/store-cmd.js',
        'resources/js/page-category/store-query.js',
	    'resources/js/product/module.js',
        'resources/js/product/store-cmd.js',
        'resources/js/product/store-query.js',
	    'resources/js/product-category/module.js',
        'resources/js/product-category/store-cmd.js',
        'resources/js/product-category/store-query.js',
	    'resources/js/discounts/module.js',
        'resources/js/discounts/store-cmd.js',
        'resources/js/discounts/store-query.js',
	    'resources/js/orders/module.js',
	    'resources/js/orders/store-cmd.js',
        'resources/js/orders/store-query.js'
    ], 'public/js/flex.js')
    .copyDirectory('node_modules', 'public/vendor')
    .sass('resources/sass/app.scss', 'public/css');

