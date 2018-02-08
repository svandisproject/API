import Vue from 'vue'
import { sync } from 'vuex-router-sync'
import router from './router'
import store from './store'
import Layout from './layouts/Layout'
import uikit from './plugins/uikit'
import configureAxios from './axios'

sync(store, router)

Vue.use(uikit)
let $eventHub = new Vue

Vue.prototype.$eventHub = $eventHub
Vue.prototype.$axios = configureAxios(store, $eventHub)

let app = new Vue({
    el: '#app',
    template: '<layout />',
    router,
    store,
    components: { Layout }
})

export { app, router, store }