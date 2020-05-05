/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
import Vuex from 'vuex'

import state from './state'
import routes from './route'
import middlewarePipeline from './middleware/pipeline'

Vue.use(VueRouter);
Vue.use(Vuex);


const router = new VueRouter({
   routes
});

router.beforeEach((to, from, next) => {
   if (!to.meta.middleware) {
       return next();
   }

   const middleware = to.meta.middleware;

   const context = {
       to,
       from,
       next,
       store
   }

   return middleware[0]({
       ...context,
       next: middlewarePipeline(context, middleware, 1)
   })

});

const store = new Vuex.Store(
    state
)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('register-family-component', require('./components/RegisterFamilyComponent.vue').default);
Vue.component('login-family-component', require('./components/LoginFamilyComponent.vue').default);
Vue.component('navbar', require('./components/NavbarComponent.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    router,
    store,
    el: '#app',
});
