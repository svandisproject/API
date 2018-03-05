import axios from 'axios';

export default function(store, $eventHub) {
    axios.interceptors.request.use((config) => {
        store.commit('START_LOADING');
        return config
    }, (error) => {
        $eventHub.$emit('axios.error', error)
        store.commit('FINISH_LOADING');
        return Promise.reject(error);
    });
    axios.interceptors.response.use((response) => {
        store.commit('FINISH_LOADING');
        return response;
    }, (error) => {
        $eventHub.$emit('axios.error', error)
        store.commit('FINISH_LOADING');
        return Promise.reject(error);
    });

    return axios
}
