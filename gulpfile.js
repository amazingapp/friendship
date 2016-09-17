const elixir = require('laravel-elixir');
const BrowserSync = require('laravel-elixir-browsersync2');
const connect = require('gulp-connect-php');

require('laravel-elixir-vue');

elixir(mix => {
    BrowserSync.init();
    mix.sass('app.scss')
       .copy('node_modules/socket.io-client/socket.io.js','public/js/socket.io.js')
       .webpack('app.js')
        .BrowserSync({
                   proxy: "http://localhost:8081"
               });
    connect.server({
        base : './public',
        port : '8081'
        });
});
