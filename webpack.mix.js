const mix = require('laravel-mix');
const path = require('path');

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

let fs = require('fs');

let getFiles = function (dir) {
  // get all 'files' in this directory
  // filter directories
  return fs.readdirSync(dir).filter(file => {
   return fs.statSync(`${dir}/${file}`).isFile();
  });
};


 mix.sass('resources/sass/app.scss', 'public/css')
     // .sass('resources/sass/pages/landing.scss', 'public/css')
     // .sass('resources/sass/pages/new-landing.scss', 'public/css')
     .js('resources/js/app.js', 'public/js')

     // Posts
    // .js('resources/js/pages/posts-featured.js', 'public/js')
     //.js('resources/js/pages/post.js', 'public/js')
     //.js('resources/js/pages/post-gallery.js', 'public/js')
     // Mods
     //.js('resources/js/pages/mod-page.js', 'public/js')
     //.js('resources/js/pages/mods-index.js', 'public/js')
     .copyDirectory('resources/images', 'public/images');

 getFiles('resources/js/pages/').forEach(function (filepath) {
  mix.js('resources/js/pages/' + filepath, 'public/js/pages');
 })