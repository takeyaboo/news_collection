/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import VueRouter from 'vue-router';


// import Sample from './components/ExampleComponent.vue';
import Top from './components/Top.vue';
import Word_list from './components/word/ListComponent.vue';
import Word_all from './components/word/AllComponent.vue';
import Word_log from './components/word/LogComponent.vue';
import Word from './components/word/WordComponent.vue';
// import Word_update from './components/word/UpdateComponent.vue';
import News_list from './components/news/ListComponent.vue';
import News_all from './components/news/AllComponent.vue';
import News_log from './components/news/LogComponent.vue';
import Graph1 from './components/graph/Graph1Component.vue';
import Graph2 from './components/graph/Graph2Component.vue';
import Graph3 from './components/graph/Graph3Component.vue';

import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
// import VuePaginate from 'vue-paginate';
import Loading from './components/Load';

Vue.use(VueRouter);
Vue.use(BootstrapVue);
// Vue.use(VuePaginate);
// Vue.component('paginate', Paginate)


const routes = [
    // { path: '/category', name: 'sample', component: Sample },
    { path: '/', name: 'top', component: Top },
    { path: '/word_vue/1', name: 'word_list', component: Word_list },
    { path: '/word_vue/2', name: 'word_all', component: Word_all },
    // { path: '/word_vue/3', name: 'word', component: Word },
    { path: '/word_vue/4', name: 'word_log', component: Word_log },
    { path: '/news_vue/1', name: 'news_list', component: News_list },
    { path: '/news_vue/2', name: 'news_all', component: News_all },
    { path: '/news_vue/4', name: 'news_log', component: News_log },
    { path: '/graph/1', name: 'graph1', component: Graph1 },
    { path: '/graph/2', name: 'graph2', component: Graph2 },
    { path: '/graph/3', name: 'graph3', component: Graph3 },
    { path: '/*', name: 'loading', component: Loading},





];

const router = new VueRouter({
    mode: 'history',
    routes
});


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */




const app = new Vue({
    router
}).$mount('#app');

// console.log(app);
