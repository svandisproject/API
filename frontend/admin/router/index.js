import Vue from 'vue'
import Router from 'vue-router'
import Dashboard from '../pages/Dashboard'

Vue.use(Router);

export default new Router({
    mode: 'hash',
    routes: [
        {
            path: '/',
            component: Dashboard
        }
    ]
})