import "./styles/theme.scss";
import Accordion from './components/Accordion'
import AccordionContent from './components/AccordionContent'
import Alert from './components/Alert'
import SliderNav from './components/SliderNav'
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
        Vue.component(Accordion.name, Accordion);
        Vue.component(AccordionContent.name, AccordionContent);
        Vue.component(Alert.name, Alert);
        Vue.component(Card.name, Card);
        Vue.component(Container.name, Container);
        Vue.component(Icon.name, Icon);
        Vue.component(Position.name, Position);
        Vue.component(Spinner.name, Spinner);
        Vue.component(SliderNav.name, SliderNav);
    }
};

export default uikit;