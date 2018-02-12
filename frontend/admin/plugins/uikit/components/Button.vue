<template>
    <button :class="getClass()">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        name: 'ui-button',
        props: {
            'default': {type: Boolean, default: false},
            'primary': {type: Boolean, default: false},
            'secondary': {type: Boolean, default: false},
            'danger': {type: Boolean, default: false},
            'text': {type: Boolean, default: false},
            'link': {type: Boolean, default: false},
            'small': {type: Boolean, default: false},
            'large': {type: Boolean, default: false}
        },
        methods: {
            getClass(){
                if(this.default && this.primary || this.default && this.secondary || this.default && this.danger || this.default && this.text || this.default && this.link ||
                   this.primary && this.secondary || this.primary && this.danger || this.primary && this.text || this.primary && this.link ||
                   this.secondary && this.danger || this.secondary && this.text || this.secondary && this.link || this.danger && this.text  ||
                   this.danger && this.link || this.text && this.link){
                    throw new Error('Style is unevident. You can not declare both properties')
                }
                if(this.small && this.large){
                    throw new Error('Style is unevident. You can not declare both large and small properties')
                }
                let classes = 'uk-button ';
                if(this.default) {
                    classes += 'uk-button-default'
                }
                if(this.primary) {
                    classes += 'uk-button-primary'
                }
                if(this.secondary) {
                    classes += 'uk-button-secondary'
                }
                if(this.danger) {
                    classes += 'uk-button-danger'
                }
                if(this.text) {
                    classes += 'uk-button-text'
                }
                if(this.link) {
                    classes += 'uk-button-link'
                }

                let size = classes;
                if(this.small){
                    size += ' uk-button-small'
                }
                if(this.large){
                    size  += ' uk-button-large'
                }
                return size;
            }
        }
    }
</script>

<style scoped>

</style>