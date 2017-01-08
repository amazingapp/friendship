
window._ = require('lodash');

window.autosize = require('autosize');
window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');
window.Vue = require('vue');
require('vue-resource');
Vue.http.interceptors.push((request, next) => {
    request.headers['X-CSRF-TOKEN'] = App.csrfToken;
    next();
});
window.moment = require('moment');

// import Echo from "laravel-echo"

// window.Echo = new Echo({
//     broadcaster: 'socket.io',
//     host: 'http://192.168.1.2:6001'
// });
// window.Echo.private('chat-room.1')
//     .listen('ChatMessageWasReceived', (e) => {
//         console.log(e.user, e.message);
//     });