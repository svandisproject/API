<template>
    <div :class="getClass()">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        name: 'ui-section',
        props: {
            'default':   {type: Boolean, default: false},
            'muted':     {type: Boolean, default: false},
            'primary':   {type: Boolean, default: false},
            'secondary': {type: Boolean, default: false}
        },
        methods: {
            getClass(){
                if( this.default && this.muted|| this.default && this.primary || this.default && this.secondary || this.muted && this.primary||
                    this.muted && this.secondary || this.primary && this.secondary){
                    throw new Error ('The Section style is unevident. You can not declare more one properties')
                }
                let classes = 'uk-section';
                if(this.default){
                    classes += '-default';
                }
                if(this.muted){
                    classes += '-muted';
                }
                if(this.primary){
                    classes += '-primary';
                }
                if(this.secondary){
                    classes += '-secondary';
                }
                return classes;
            }
        }
    }
</script>

<style scoped>

</style>