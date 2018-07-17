let mix = require('laravel-mix')

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

mix.js('resources/assets/js/app.js', 'public/js')
  .copyDirectory('resources/assets/img', 'public/img')
  .sass('resources/assets/sass/app.scss', 'public/css')

if (mix.inProduction()) {
  mix.version()
} else {
  mix.extract(['bootstrap', 'popper.js', 'vue', 'jquery'])
    .sourceMaps()
    .browserSync({
      proxy: {
        target: 'https://homestead.test',
        ws: true
      },
      host: '192.168.10.10',
      port: 3000,
      https: {
        key: '/etc/nginx/ssl/homestead.test.key',
        cert: '/etc/nginx/ssl/homestead.test.crt'
      },
      open: false,
      ghostMode: false,
      reloadDelay: 1000,
      files: [
        'app/**/*.php',
        'routes/**/*.php',
        'resources/lang/ru.json',
        'resources/lang/**/*.php',
        'resources/views/**/*.php',
        'resources/assets/**/*.js',
        'resources/assets/js/**/*.vue',
        'public/js/**/*.js',
        'public/css/**/*.css'
      ],
      watchEvents: ['change', 'add', 'unlink', 'addDir', 'unlinkDir'],
      watchOptions: {
        usePolling: true,
        interval: 500
      }
    })
}
