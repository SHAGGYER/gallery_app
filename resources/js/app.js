
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.moment = require('moment');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

/**
 * Vue Router
 */

import routes from './routes';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

const router = new VueRouter({
    routes: routes
});


/**
 * Vuex
 */

import Vuex from 'vuex';
Vue.use(Vuex);

import Store from './store';
const store = new Vuex.Store({
    state: {
        loading: true,
    },

    mutations: {
        setLoading(state, value) {
            state.loading = value;
        }
    },
});



/**
 * Components
 */

/*
Nprogress
 */

import 'nprogress/nprogress.css';

/*
Spinner
 */

/**
 * Spinner
 *
 *
 */


Vue.component('spinner', require('vue-simple-spinner'));


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import App from './app.vue';

new Vue({
    router: router,
    store: store,
    render: h => h(App)
}).$mount('#app');
