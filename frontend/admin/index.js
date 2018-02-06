import Vue from 'vue'
import { sync } from 'vuex-router-sync'
import router from './router'
import store from './store'
import Layout from './layouts/Layout'
import uikit from './plugins/uikit'

sync(store, router)

Vue.use(uikit);

let app = new Vue({
    el: '#app',
    template: '<layout />',
    router,
    store,
    components: { Layout }
})

export { app, router, store }