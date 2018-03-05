<template>
    <nav :class="{
        'uk-navbar': !container,
        'uk-navbar-contatiner': container
    }" uk-navbar>
        <div class="uk-navbar-left" v-if="$slots['left']">
            <slot name="logo"></slot>
            <slot name="left"></slot>
        </div>
        <div class="uk-navbar-center" v-if="$slots['center']">
            <ul class="uk-navbar-nav">
                <slot name="center"></slot>
            </ul>
        </div>
        <div class="uk-navbar-right" v-if="$slots['right']">
            <ul class="uk-navbar-nav">
                <slot name="right"></slot>
            </ul>
        </div>
    </nav>
</template>

<script>
    export default {
        name: 'ui-navbar',
        props: {
            'container': { type: Boolean, default: false }
        }
    }
</script>

<style scoped>

</style>