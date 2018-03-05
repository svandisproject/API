import Datatable from './Datatable'
import VueDatatable from '../vue2-datatable'
import TextFilter from './filters/TextFilter'
import TableTimeago from './components/TableTimeago'
import Actions from './components/Actions'

const datatable = {
    install(Vue) {
        Vue.use(VueDatatable)
        Vue.component(TextFilter.name, TextFilter)
        Vue.component(Actions.name, Actions)
        Vue.component(TableTimeago.name, TableTimeago)
        Vue.component(Datatable.name, Datatable)
    }
};

export default datatable;