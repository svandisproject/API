import Vue from 'vue'
import Router from 'vue-router'
import Dashboard from '../pages/Dashboard'
import Login from '../pages/Login'
import Tag from '../pages/Tag'
import Feeds from '../pages/Feeds'
import Settings from '../pages/Settings'
import Workers from '../pages/settings/Workers'
import WebFeeds from '../pages/settings/WebFeeds'
import WebFeed from '../pages/WebFeed'
import FacebookFeed from '../components/FacebookFeed'
import TwitterFeed from '../components/TwitterFeed'
import Feed from '../components/Feed'
import WebFeedForm from '../pages/settings/WebFeedForm'
import FacebookUsers from '../pages/settings/FacebookUsers'
import TwitterUsers from '../pages/settings/TwitterUsers'
import FacebookUserForm from '../pages/settings/FacebookUserForm'
import TwitterUserForm from '../pages/settings/TwitterUserForm'

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
                    component: WebFeed,
                    children: [
                        {
                            name: 'web-feed',
                            path: '/feeds/web/:id',
                            component: Feed
                        }
                    ]
                },
                {
                    name: 'feeds_facebook',
                    path: '/feeds/facebook',
                    component: FacebookFeed
                },
                {
                    name: 'feeds_twitter',
                    path: '/feeds/twitter',
                    component: TwitterFeed
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
                    path: '/settings/workers',
                    component: Workers
                },
                {
                    name: 'settings_web_feeds',
                    path: '/settings/web-feeds',
                    component: WebFeeds,
                },
                {
                    name: 'settings_web_feeds_new',
                    path: '/settings/web-feeds/new',
                    component: WebFeedForm
                },
                {
                    name: 'settings_web_feeds_edit',
                    path: '/settings/web-feeds/edit/:id',
                    component: WebFeedForm
                },
                {
                    name: 'settings_facebook_users',
                    path: '/settings/facebook-users',
                    component: FacebookUsers
                },
                {
                    name: 'settings_facebook_users_new',
                    path: '/settings/facebook-users/new',
                    component: FacebookUserForm
                },
                {
                    name: 'settings_facebook_users_edit',
                    path: '/settings/facebook-users/edit/:id',
                    component: FacebookUserForm
                },
                {
                    name: 'settings_twitter_users',
                    path: '/settings/twitter-users',
                    component: TwitterUsers
                },
                {
                    name: 'settings_twitter_users_new',
                    path: '/settings/twitter-users/new',
                    component: TwitterUserForm
                },
                {
                    name: 'settings_twitter_users_edit',
                    path: '/settings/twitter-users/edit/:id',
                    component: TwitterUserForm
                },
            ]
        }
    ]
})



export default router;