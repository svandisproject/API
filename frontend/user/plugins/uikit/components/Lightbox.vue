<template>
    <div :uk-lightbox="(animation !== '') ? 'animation: '+ animation : ''">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        name: 'ui-lightbox',
        props: {
            'animation': {
                type: String,
                default: '',
                validator: (value) => {
                    return ['', 'fade', 'scale', 'slide'].indexOf(value) > -1
                }
            },
        }
    }
</script>

<style scoped>

</style>