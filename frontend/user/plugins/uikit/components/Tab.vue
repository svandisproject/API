<template>
    <ul :class="{
                 'uk-tab-bottom':  position === 'bottom',
                 'uk-tab-left':    position === 'left',
                 'uk-tab-right':   position === 'right',
                 'uk-flex-right':  alignment === 'flex-right',
                 'uk-flex-left':   alignment === 'flex-left',
                 'uk-flex-center': alignment === 'flex-center',

    } " uk-tab>
        <slot></slot>
    </ul>
</template>

<script>
    export default {
        name: 'ui-tab',
        props: {
            position: {
                type: String,
                default: '',
                validator: (value) => {
                    return ['bottom', 'left', 'right', ''].indexOf(value) > -1
                }
            },
            alignment: {
                type: String,
                default: '',
                validator: (value) => {
                    return ['flex-right', 'flex-left', 'flex-center', ''].indexOf(value) > -1
                }
            }
        }
    }
</script>

<style scoped>

</style>