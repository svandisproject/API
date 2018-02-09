<template>
    <div :class="getClass()">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        name: 'navbar-container-position',
        props: {
            'left': {type: Boolean, default: false},
            'right': {type: Boolean, default: false},
            'center': {type: Boolean, default: false},
        },
        methods: {
            getClass() {
                if (this.left && this.right || this.left && this.center || this.right && this.center) {
                    throw new Error('Position is unevident. You can not declare more one property')
                }
                let classes = 'uk-navbar';
                if(this.center) {
                    classes += '-center'
                }
                if(this.left) {
                    classes += '-left'
                }
                if(this.right) {
                    classes += '-right'
                }
                return classes;
            }
        }
    }
</script>

<style scoped>

</style>