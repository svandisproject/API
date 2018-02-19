import Vue from 'vue'
import Router from 'vue-router'
import Dashboard from '../pages/Dashboard'
import Login from '../pages/Login'
import Tag from '../pages/Tag'
import Feeds from '../pages/Feeds'
import Settings from '../pages/Settings'
import Workers from '../pages/Workers'

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
            component: Dashboard,
            props: {'access': ['ROLE_USER', 'ROLE_ADMIN']}
        },
        {
            name: 'feeds',
            path: '/feeds',
            component: Feeds,
            props: {'access': ['ROLE_ADMIN']},
            children: [
                {
                    name: 'feeds_web',
                    path: '/feeds/web',
                    component: Feeds
                },
                {
                    name: 'feeds_facebook',
                    path: '/feeds/facebook',
                    component: Feeds
                },
                {
                    name: 'feeds_twitter',
                    path: '/feeds/twitter',
                    component: Feeds
                }
            ]
        },
        {
            name: 'settings',
            path: '/settings',
            component: Settings,
            props: {'access': ['ROLE_ADMIN']},
            children: [
                {
                    name: 'settings_workers',
                    path: '/settings_workers',
                    component: Workers
                }
            ]
        }
    ]
})



export default router;