import "./styles/theme.scss";
import Accordion from './components/Accordion'
import AccordionContent from './components/AccordionContent'
import Alert from './components/Alert'
import Align from './components/Align'
import Card from './components/Card'
import Container from './components/Container'
import Icon from './components/Icon'
import NavbarContainer from './components/NavbarContainer'
import NavbarContainerPosition from './components/NavbarContainerPosition'
import NavbarContainerPositionList from './components/NavbarContainerPositionList'
import SliderNav from './components/SliderNav'
import Spinner from './components/Spinner'
import Position from './components/Position'

import UIkit from 'uikit'
import Icons from 'uikit-icons'

UIkit.use(Icons)

const uikit = {
    install(Vue, options) {
        Vue.component(Accordion.name, Accordion);
        Vue.component(AccordionContent.name, AccordionContent);
        Vue.component(Alert.name, Alert);
        Vue.component(Align.name, Align);
        Vue.component(Card.name, Card);
        Vue.component(Container.name, Container);
        Vue.component(Icon.name, Icon);
        Vue.component(NavbarContainer.name, NavbarContainer);
        Vue.component(NavbarContainerPosition.name, NavbarContainerPosition);
        Vue.component(NavbarContainerPositionList.name, NavbarContainerPositionList);
        Vue.component(Position.name, Position);
        Vue.component(Spinner.name, Spinner);
        Vue.component(SliderNav.name, SliderNav);
    }
};

export default uikit;