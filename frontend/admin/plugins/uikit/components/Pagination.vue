<template>
    <ul :class="getPaginationClass()" uk-margin>
       <slot></slot>
    </ul>
</template>

<script>
    export default {
        name: 'ui-pagination',
        props: {
            'flexCenter': {type: Boolean, default: false},
            'flexLeft':   {type: Boolean, default: false},
            'flexRight':  {type: Boolean, default: false}
        },
        methods: {
            getPaginationClass(){
                if(this.flexCenter && this.flexLeft || this.flexCenter && this.flexRight || this.flexLeft && this.flexRight){
                    throw new Error ('You can`t use flex center with flex left or flex right!')
                }
                let classes = 'uk-pagination ';
                if(this.flexCenter){
                    classes += ' uk-flex-center'
                }
                if(this.flexLeft){
                    classes += ' uk-flex-left'
                }
                if(this.flexRight){
                    classes += ' uk-flex-right'
                }
                return classes;
            }
        }
    }
</script>

<style scoped>

</style>