<template>
    <div :class="{
                  'uk-padding': size === 'default',
                  'uk-padding-small': size === 'small',
                  'uk-padding-large': size === 'large',
                  'uk-padding-remove-top': remove.indexOf('top') > -1,
                  'uk-padding-remove-bottom': remove.indexOf('bottom') > -1,
                  'uk-padding-remove-right':  remove.indexOf('right') > -1,
                  'uk-padding-remove-left':   remove.indexOf('left') > -1,
                  'uk-padding-remove-vertical': remove.indexOf('vertical') > -1,
                  'uk-padding-remove-horizontal': remove.indexOf('horizontal') > -1
               }">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        name: 'ui-padding',
        props: {
            'size': {
            type: String,
            default: 'default',
            validator: (value) => {
                    return ['small', 'large', 'default'].indexOf(value) > -1
                },

            },
            'remove': {
                type: Array,
                default: []
            }
        }
    }
</script>