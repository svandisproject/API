import "./styles/theme.scss";
import Spinner from './components/Spinner'
import UIkit from 'uikit'

const uikit = {
    install(Vue, options) {
        Vue.component(Spinner.name, Spinner);
    }
};

export default uikit;