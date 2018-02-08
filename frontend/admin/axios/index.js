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

    axios.postFormData = (url, data) => {
        let formData = new FormData();
        Object.keys(data).map((key)=> {
            formData.append(key, data[key])
        })
        return axios.post(url, formData)
    }

    return axios
}
