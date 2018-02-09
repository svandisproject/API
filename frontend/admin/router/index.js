import Vue from 'vue'
import Router from 'vue-router'
import Dashboard from '../pages/Dashboard'
import Login from '../pages/Login'
import Tag from '../pages/Tag'

Vue.use(Router);

const router = new Router({
    base: '/admin',
    mode: 'history',
    routes: [
        {
            name: 'login',
            path: '/login',
            component: Login
        },
        {
            name: 'tag',
            path: '/tag',
            component: Tag
        },
        {
            name: 'dashboard',
            path: '/',
            component: Dashboard
        }
    ]
})



export default router;