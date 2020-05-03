const mix = require("laravel-mix");
const tailwindcss = require("tailwindcss");
// const progress = require('progress-bar-webpack-plugin');
// const ErrorOverlay = require('error-overlay-webpack-plugin');
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

const ip = require('ip').address() || 'localhost';

mix.js("resources/js/app.js", "public/js")

    .sass("resources/sass/app.scss", "public/css")
    .options({
        processCssUrls: false,
        postCss: [tailwindcss("tailwind.config.js")]
    })
    .sourceMaps()
    .webpackConfig({
        // plugins: [
        //     require('progress-bar-webpack-plugin')(),
        //     new ErrorOverlay()
        // ],
        devServer: {
            overlay: true,
            // open: true,
            // openPage: 'http://localhost:8000',
        }
    })
    .browserSync(ip + ':8000')


