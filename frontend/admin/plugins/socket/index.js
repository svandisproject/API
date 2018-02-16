import VueSocketio from 'vue-socket.io';
import store from '../../store'
import config from '../../config'

const socket = {
    install(Vue) {
        Vue.use(VueSocketio, config.SOCKET_SERVER_URL, store);
    }
};

export default socket;