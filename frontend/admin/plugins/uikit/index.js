import "./styles/theme.scss";
import Spinner from './components/Spinner'
import Position from './components/Position'
import Container from './components/Container'

import UIkit from 'uikit'

const uikit = {
    install(Vue, options) {
        Vue.component(Spinner.name, Spinner);
        Vue.component(Position.name, Position);
        Vue.component(Container.name, Container);
    }
};

export default uikit;