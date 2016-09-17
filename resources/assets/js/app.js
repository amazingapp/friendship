require('./bootstrap');
Vue.component('post-status-comments',require('./components/Comments.vue') );

// main Vue
const app = new Vue({
    el: 'body'
});