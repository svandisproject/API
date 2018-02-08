import "./styles/theme.scss";
import Spinner from './components/Spinner'
import Position from './components/Position'
import UIkit from 'uikit'

const uikit = {
    install(Vue, options) {
        Vue.component(Spinner.name, Spinner);
        Vue.component(Position.name, Position);
    }
};

export default uikit;