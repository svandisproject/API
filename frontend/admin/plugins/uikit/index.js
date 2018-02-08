import "./styles/theme.scss";
import SliderNav from './components/slider-navigation/SliderNav'
import Spinner from './components/Spinner'
import Position from './components/Position'
import UIkit from 'uikit'

const uikit = {
    install(Vue, options) {
        Vue.component(Spinner.name, Spinner);
        Vue.component(Position.name, Position);
        Vue.component(SliderNav.name, SliderNav);
    }
};

export default uikit;