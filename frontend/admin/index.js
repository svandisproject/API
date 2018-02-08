import Vue from 'vue'
import { sync } from 'vuex-router-sync'
import router from './router'
import store from './store'
import Layout from './layouts/Layout'
import uikit from './plugins/uikit'
import configureAxios from './axios'
import VeeValidate from 'vee-validate';
import auth from './plugins/auth';

sync(store, router)

import './styles/base.scss'

Vue.use(VeeValidate);
Vue.use(uikit)
let $eventHub = new Vue

Vue.prototype.$eventHub = $eventHub
Vue.prototype.$axios = configureAxios(store, $eventHub)

Vue.use(auth)

let app = new Vue({
    el: '#app',
    template: '<layout />',
    router,
    store,
    components: { Layout }
})

export { app, router, store }