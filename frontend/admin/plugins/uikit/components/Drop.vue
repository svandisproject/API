<template>
    <div :uk-drop="position()"></div>
</template>

<script>
    export default {
        name: 'ui-drop',
        props: {
                'pos':['bottom-left', 'bottom-center', 'bottom-right', 'bottom-justify', 'top-left', 'top-center', 'top-right',
                       'top-justify', 'left-top', 'left-center', 'left-bottom', 'right-top', 'right-center', 'right-bottom']
        },
        methods: {
            position(){
                let position;

            }
        }
    }

</script>

<style scoped>

</style>

