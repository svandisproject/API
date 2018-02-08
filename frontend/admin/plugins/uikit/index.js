import "./styles/theme.scss";
import Spinner from './components/Spinner'
import Position from './components/Position'
import Container from './components/Container'
import Card from './components/Card'
import Icon from './components/Icon'

import UIkit from 'uikit'
import Icons from 'uikit-icons'

UIkit.use(Icons)

const uikit = {
    install(Vue, options) {
        Vue.component(Card.name, Card);
        Vue.component(Container.name, Container);
        Vue.component(Icon.name, Icon);
        Vue.component(Position.name, Position);
        Vue.component(Spinner.name, Spinner);
    }
};

export default uikit;