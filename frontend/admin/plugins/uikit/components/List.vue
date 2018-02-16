<template>
    <ul class="uk-list" :class="getClass()">
       <slot></slot>
    </ul>
</template>

<script>
    export default {
        name: 'ui-list',
        props: {
            'bullet' : {type: Boolean, default: false},
            'divider': {type: Boolean, default: false},
            'striped': {type: Boolean, default: false}
        },
        methods: {
            getClass(){
                if(this.bullet && this.divider || this.bullet && this.striped || this.divider && this.striped){
                    throw new Error('The list style is unevident. You can not declare more one properties')
                }
                let classes = 'uk-list';
                if(this.bullet){
                    classes += '-bullet'
                }
                if(this.divider){
                    classes += '-divider'
                }
                if(this.striped){
                    classes += '-striped'
                }
                return classes;
            }
        }
    }
</script>

<style scoped>

</style>