import store from '../../store'
import router from '../../router'
import Login from './Login'
import Logout from './Logout'
import config from '../../config'

const auth = {
    install(Vue) {
        Vue.prototype.$auth = {}
        Vue.prototype.$auth.user = store.getters.getUser
        Vue.prototype.$auth.authenticated = () => { return store.getters.getUser !== null && store.getters.getToken };
        Vue.prototype.$auth.hasRole = (role) => { return store.getters.getUser.roles.indexOf(role) > -1 }
        Vue.component(Login.name, Login)
        Vue.component(Logout.name, Logout)

        router.beforeEach((to, from, next) => {
            if(to.name === 'login' &&
                store.getters.getToken &&
                store.getters.getUser.roles.indexOf(config.AUTH.ADMIN_AREA_ACCESS_ROLE) > -1) {
                return next({name: 'dashboard'})
            }
            if(store.getters.getToken && store.getters.getUser.roles.indexOf(config.AUTH.ADMIN_AREA_ACCESS_ROLE) > -1) {
                let access = false;
                for(let i in store.getters.getUser.roles) {
                    if (to.matched[0].props.default.access.indexOf(store.getters.getUser.roles[i]) > -1) {
                        access = true;
                        break;
                    }
                }
                if(!access) {
                    return false
                }
                return next()
            }
            if(to.name === 'login' && !store.getters.getToken) {
                return next()
            }
            return next({name: 'login'})
        })
    }
};

export default auth;