<template>
    <button :class="getClass()" type="button" uk-close></button>
</template>

<script>
    export default {
        name: 'ui-close',
        props: {
            'large': {type: Boolean, default: false}
        },
        methods: {
            getClass(){
                let classes = 'uk-close';
                if(this.large){
                    classes += '-large '
                    return classes;
                }
            }
        }
    }

</script>

<style scoped>

</style>