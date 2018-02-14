import Vue from 'vue'
import { sync } from 'vuex-router-sync'
import VeeValidate from 'vee-validate';
import Notifications from 'vue-notification'
import router from './router'
import store from './store'
import socket from './plugins/socket'
import Layout from './layouts/Layout'
import uikit from './plugins/uikit'
import configureAxios from './axios'
import auth from './plugins/auth';

sync(store, router)

import './styles/base.scss'

let $eventHub = new Vue
Vue.prototype.$eventHub = $eventHub

Vue.use(VeeValidate);
Vue.use(Notifications)
Vue.use(uikit)
Vue.use(socket)
Vue.use(auth)

Vue.prototype.$axios = configureAxios(store, $eventHub)


let app = new Vue({
    el: '#app',
    template: '<layout />',
    router,
    store,
    components: { Layout },
    created() {
        if(this.$store.getters.getToken) {
            this.$axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.$store.getters.getToken;
        }
    }
})

export { app, router, store }