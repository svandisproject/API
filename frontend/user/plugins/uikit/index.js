import "./styles/theme.scss";
import Accordion from './components/Accordion'
import AccordionContent from './components/AccordionContent'
import Alert from './components/Alert'
import Align from './components/Align'
import Article from './components/Article'
import ArticleTitle from './components/ArticleTitle'
import ArticleMeta from './components/ArticleMeta'
import Breadcrumb from './components/Breadcrumb'
import Button from './components/Button'
import ButtonGroup from './components/ButtonGroup'
import Card from './components/Card'
import Close from './components/Close'
import Column from './components/Column'
import CountDown from './components/CountDown'
import Container from './components/Container'
import Cover from './components/Cover'
import DescriptionList from './components/DescriptionList'
import Divider from './components/Divider'
import Dotnav from './components/Dotnav'
import Drop from './components/Drop'
import Dropdown from './components/Dropdown'
import Icon from './components/Icon'
import Inverse from './components/Inverse'
import Label from './components/Label'
import Lightbox from './components/Lightbox'
import List from './components/List'
import Heading from './components/Heading'
import Navbar from './components/Navbar'
import OffCanvas from './components/OffCanvas'
import Overlay from './components/Overlay'
import Padding from './components/Padding'
import Pagination from './components/Pagination'
import PaginationList from './components/PaginationList'
import Placeholder from './components/Placeholder'
import Search from './components/Search'
import SliderNav from './components/SliderNav'
import Spinner from './components/Spinner'
import Section from './components/Section'
import Slider from './components/Slider'
import Tab from './components/Tab'
import Totop from './components/Totop'
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
        Vue.component(Article.name, Article);
        Vue.component(ArticleTitle.name, ArticleTitle);
        Vue.component(ArticleMeta.name, ArticleMeta);
        Vue.component(Breadcrumb.name, Breadcrumb);
        Vue.component(Button.name, Button);
        Vue.component(ButtonGroup.name, ButtonGroup);
        Vue.component(Card.name, Card);
        Vue.component(Close.name, Close);
        Vue.component(Column.name, Column);
        Vue.component(CountDown.name, CountDown);
        Vue.component(Container.name, Container);
        Vue.component(Cover.name, Cover);
        Vue.component(DescriptionList.name, DescriptionList);
        Vue.component(Divider.name, Divider);
        Vue.component(Dotnav.name, Dotnav);
        Vue.component(Drop.name, Drop);
        Vue.component(Dropdown.name, Dropdown);
        Vue.component(Icon.name, Icon);
        Vue.component(Inverse.name, Inverse);
        Vue.component(Label.name, Label);
        Vue.component(Lightbox.name, Lightbox);
        Vue.component(List.name, List);
        Vue.component(Heading.name, Heading);
        Vue.component(Navbar.name, Navbar);
        Vue.component(OffCanvas.name, OffCanvas);
        Vue.component(Overlay.name, Overlay);
        Vue.component(Padding.name, Padding);
        Vue.component(Pagination.name, Pagination);
        Vue.component(PaginationList.name, PaginationList);
        Vue.component(Placeholder.name, Placeholder);
        Vue.component(Position.name, Position);
        Vue.component(Spinner.name, Spinner);
        Vue.component(Search.name, Search);
        Vue.component(SliderNav.name, SliderNav);
        Vue.component(Section.name, Section);
        Vue.component(Slider.name, Slider);
        Vue.component(Tab.name, Tab);
        Vue.component(Totop.name, Totop);
    }
};

export default uikit;