<template>
    <div :class="getClass()"></div>
</template>

<script>
    export default {
        name: 'ui-column',
        props: {
           '2': {type: Number, default: false},
           '1-3': {type: Number, default: false},
           '1-4': {type: Number, default: false},
           '1-5': {type: Number, default: false},
           '1-6': {type: Number, default: false}
        },
        methods: {
            getClass(){

            }
        }

    }
</script>

<style scoped>

</style>