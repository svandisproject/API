<template>
    <nav :class="getClass()" uk-navbar>
        <slot>

        </slot>
    </nav>
</template>

<script>
    export default {
        name: 'ui-navbar-wrap',
        props: {
            'container': {type: Boolean, default: false}
        },
        methods: {
            getClass() {
                let classes = '';
                if(this.container){
                    classes = 'uk-navbar-container';
                }
                else{
                    classes = 'uk-navbar';
                }
                return classes;
            }
        }
    }
</script>

<style scoped>

</style>