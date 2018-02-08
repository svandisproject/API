import "./styles/theme.scss";
import SliderNav from './components/slider-navigation/SliderNav'
import Spinner from './components/Spinner'
import UIkit from 'uikit'

const uikit = {
    install(Vue, options) {
        Vue.component(Spinner.name, Spinner);
        Vue.component(SliderNav.name, SliderNav);
    }
};

export default uikit;