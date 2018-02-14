<template>
    <div :uk-lightbox="getAnimationStyle()">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        name: 'ui-lightbox',
        props: {
            'uk-lightbox': {type: Boolean, default: true},
            'fade':        {type: Boolean, default: false},
            'slide':       {type: Boolean, default: false},
            'scale':       {type: Boolean, default: false}
        },
        methods: {
            getAnimationStyle(){
                if(this.fade && this.slide || this.fade && this.scale || this.slide && this.scale){
                    throw new Error('Animation style is unevident. Choose one style')
                }
                let animaStyle = 'animation: '
                if(this.fade){
                    animaStyle += '-fade'
                }
                if(this.slide){
                    animaStyle += '-slide'
                }
                if(this.scale){
                    animaStyle += '-scale'
                }
                return animaStyle;
            }
        }
    }
</script>

<style scoped>

</style>