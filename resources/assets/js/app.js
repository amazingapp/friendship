require('./bootstrap');
Vue.component('timeline',require('./components/Timeline.vue') );
// Vue.component('post-status-comments',require('./components/Comments.vue') );
Vue.component('post-comments',require('./components/PostComments.vue') );
// main Vue
const app = new Vue({
    el: 'body'
});