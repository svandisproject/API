import Vue from 'vue';
import VueTimeago from 'vue-timeago';
import VueHighcharts from 'vue-highcharts';
import Highcharts from 'highcharts/highstock';
import { sync } from 'vuex-router-sync';
import VeeValidate from 'vee-validate';
import Notifications from 'vue-notification';
import router from './router';
import store from './store';
import socket from './plugins/socket';
import Layout from './layouts/Layout';
import uikit from './plugins/uikit';
import configureAxios from './axios';
import auth from './plugins/auth';
import datatable from './plugins/datatable';
import './styles/base.scss';

Vue.use(VueHighcharts, { Highcharts });

sync(store, router);

const $eventHub = new Vue();
Vue.prototype.$eventHub = $eventHub;

Vue.use(VueTimeago, {
  name: 'timeago',
  locale: 'en-US',
  locales: {
    /* eslint global-require: "off" */
    'en-US': require('vue-timeago/locales/en-US.json'),
  },
});
Vue.use(VeeValidate);
Vue.use(Notifications);
Vue.use(uikit);
Vue.use(socket);
Vue.use(auth);
Vue.use(datatable);

Vue.prototype.$axios = configureAxios(store, $eventHub);

const app = new Vue({
  el: '#app',
  components: { Layout },
  created() {
    if (this.$store.getters.getToken) {
      if (this.$store.getters.getUser.exp <= new Date().getTime() / 1000) {
        this.$store.commit('LOGOUT');
        this.$router.push({ name: 'login' });
      } else {
        this.$axios.defaults.headers.common.Authorization = `Bearer ${this.$store.getters.getToken}`;
      }
    }
  },
  template: '<layout />',
  router,
  store,
});

export { app, router, store };
