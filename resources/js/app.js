/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';

import BootstrapVue from 'bootstrap-vue';

import Viewer from 'v-viewer';

import routes from './routes';

import store from './store';

import MainApp from './components/MainApp.vue';

import { initialize } from './helpers/default';

import VueSocketIO from "vue-socket.io";

Vue.use(VueRouter);

Vue.use(BootstrapVue);

Vue.use(Viewer);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const router = new VueRouter(routes);

initialize(store, router);

Vue.use(
    new VueSocketIO({
        debug: true,
        connection: "http://192.168.10.10:3000",
        vuex: {
            store
        }
    })
);

const app = new Vue({
    store,
    router: router,
    components: {
        MainApp
    }
}).$mount('#app');