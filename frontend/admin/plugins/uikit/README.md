KAMI Edition - UIKIT components adapted for use by VUE.js
==========

This edition provides easiest way to using UIKIT components with Vue.js.

All components have a prefix uk

##How to using UIKIT components


#Components: 

##Accordion 
###Create a list of items that can be shown individually by clicking an item's header.
The Accordion component consists of a parent container with the uk-accordion attribute receiving attributes: 
####notCollapsible - Don`t allow all items to be closed
####multiple - Allow multiple open items.
For template use <uk-accordion ></uk-accordion>   
Title and content part for each accordion item in sub-component AccordionContent(<uk-accordion-content>) - is static and
you can rewrite it. For make  open item 