import VueSocketio from 'vue-socket.io'
import store from '../../store'
import config from '../../config'
import io from 'socket.io-client'

const socket = {
    install(Vue) {
        Vue.use(VueSocketio, io(config.SOCKET_SERVER_URL, {
            query: 'token=' + store.getters.getToken
        }), store);
    }
};


export default socket;