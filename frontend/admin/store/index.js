import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex)

const state = {
   loading: false,
   user: {
       roles: []
   },
   token: null,
}

const mutations = {
    START_LOADING (state) {
        state.loading = true
    },
    FINISH_LOADING (state) {
        state.loading = false
    },
    SET_JWT_TOKEN (state, token) {
        state.token = token
    },
    SET_USER (state, user) {
        state.user = user;
    },
    LOGOUT(state) {
        state.token = null
        state.user = null
    }
}

const actions = {
    incrementAsync ({ commit }) {
        setTimeout(() => {
            commit('INCREMENT')
        }, 200)
    }
}

const getters = {
    isLoading:      (state) => { return state.loading },
    getUser:        (state) => { return state.user },
    getToken:       (state) => { return state.token },
}

const store = new Vuex.Store({
    state,
    mutations,
    actions,
    getters,
    plugins: [ createPersistedState() ]
})

export default store