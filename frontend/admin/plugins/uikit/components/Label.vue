<template>
    <span class="uk-label" :class="getClass()">
        <slot></slot>
    </span>
</template>

<script>
    export default {
        name: 'ui-label',
        props: {
            'success':{type: Boolean, default: false},
            'warning':{type: Boolean, default: false},
            'danger':{type: Boolean, default: false}
        },
        methods: {
            getClass(){
                if(this.success && this.warning || this.success && this.danger || this.warning && this.danger){
                    throw new Error('Style is unevident. You can not declare more one property')
                }
                let classes = 'uk-label';
                if(this.success){
                    classes += '-success'
                }
                if(this.warning){
                    classes += '-warning'
                }
                if(this.danger){
                    classes += '-danger'
                }
                return classes;
            }
        }
    }
</script>

<style scoped>

</style>