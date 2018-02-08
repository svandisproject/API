import store from '../../store'
import router from '../../router'
import Login from './Login'
import Logout from './Logout'

const auth = {
    install(Vue) {
        Vue.component(Login.name, Login)
        Vue.component(Logout.name, Logout)

        router.beforeEach((to, from, next) => {
            if(to.name === 'login' && store.getters.getToken) {
                return next({name: 'dashboard'})
            }
            if(store.getters.getToken) {
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