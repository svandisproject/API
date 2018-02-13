<template>
    <hr :class="getClass()">
</template>

<script>
    export default {
        name: 'ui-divider',
        props: {
            'icon': {type: Boolean, default: false},
            'small': {type: Boolean, default: false}
        },
        methods: {
            getClass(){
                if(this.icon && this.small){
                    throw new Error('Properties is unevident. You can not declare both icon and small properties')
                }
                let classes = 'uk-divider';
                if(this.icon){
                    classes += '-icon'
                }
                if(this.small){
                    classes += '-small'
                }
                return classes;
            }
        }
    }
</script>

<style scoped>

</style>