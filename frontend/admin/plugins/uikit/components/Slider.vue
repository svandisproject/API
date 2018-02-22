<template>
    <div :class="" :uk-slider="{
    'autoplay': options === 'autoplay',
    'autoplay-interval': options === 'interval',
    'center': options === 'center',
    'finite': options === 'finite',
    'index': options === 'index',
    'pause-on-hover': options === 'hover',
    'sets': options === 'sets',
    'velocity': options === 'velocity'
    }">
            <slot></slot>
    </div>
</template>

<script>
    export default {
        name: 'ui-slider',
        props:{
            'options':{
                type: String,
                default: '',
                validator: (value) => {
                    return ['autoplay', 'center', 'finite', 'hover', 'sets', 'interval', 'index', 'velocity'].indexOf(value) > -1
                },
            }
        }
    }
</script>

<style scoped>

</style>