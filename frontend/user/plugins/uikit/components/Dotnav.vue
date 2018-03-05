<template>
    <ul class="uk-dotnav" :class="getClass()">
        <!--<li class="uk-active"><a href=""></a></li>-->
        <!--<li><a href=""></a></li>-->
        <slot></slot>
    </ul>
</template>

<script>
    export default {
        name: 'ui-dotnav',
        props: {
            'vertical': {type: Boolean, default: false }
        },
        methods: {
            getClass(){
                let classes;
                if(this.vertical){
                    classes = 'uk-dotnav-vertical';
                }
                return classes;
            }
        }
    }
</script>

<style scoped>

</style>