import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const state = {
   loading: false
}

const mutations = {
    START_LOADING (state) {
        state.loading = true
    },
    FINISH_LOADING (state) {
        state.loading = false
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
    loading: (state) => { return state.loading }
}

const store = new Vuex.Store({
    state,
    mutations,
    actions,
    getters
})

export default store