import "./styles/theme.scss";
import SliderNav from './components/SliderNav'
import Spinner from './components/Spinner'
import Position from './components/Position'
import Accordion from './components/Accordion'
import UIkit from 'uikit'

const uikit = {
    install(Vue, options) {
        Vue.component(Spinner.name, Spinner);
        Vue.component(Position.name, Position);
        Vue.component(SliderNav.name, SliderNav);
        Vue.component(Accordion.name, Accordion);
    }
};

export default uikit;