<template>
    <div>
    <div :class="getClass()">
        <slot></slot>
    </div>

    </div>
</template>

<script>
    export default {
        name: 'ui-inverse',
        props:{
            'light':{type: Boolean, default: false},
            'black':{type: Boolean, default: false}
        },
        methods: {
            getClass(){
                if(this.light && this.black){
                    throw new Error('Inverse the style is unevident. You can not declare more one properties')
                }
                let classes;
                if(this.light){
                    classes = 'uk-light uk-background-secondary'
                }
                if(this.black){
                    classes = 'uk-black uk-background-muted'
                }
                console.log(classes)
                return classes;
            }
        }
    }



</script>

<style scoped>

</style>