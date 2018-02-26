import Datatable from './Datatable'
import VueDatatable from '../vue2-datatable'
import TextFilter from './filters/TextFilter'

const datatable = {
    install(Vue) {
        Vue.use(VueDatatable)
        Vue.component(TextFilter.name, TextFilter)
        Vue.component(Datatable.name, Datatable)
    }
};

export default datatable;