<template>
    <div>
        <div class="wrapper">
            <div :class="getClass()" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <slot>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</slot>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'ui-alert',
        props: {
            primary: {type: Boolean, default: false},
            success: {type: Boolean, default: false},
            warning: {type: Boolean, default: false},
            danger:  {type: Boolean, default: false},
        },
        methods: {
            getClass() {
                if(this.primary && this.success || this.primary && this.warning || this.primary && this.danger ){
                    throw new Error('Alert message: several styles of modifiers are not available')
                }
                if( this.success && this.warning || this.success && this.danger || this.warning && this.danger)
                    throw new Error('some ')
                let classes = 'uk-alert';
                if(this.primary) {
                    classes += '-primary'
                }
                if(this.success) {
                    classes += '-success'
                }
                if(this.warning) {
                    classes += '-warning'
                }
                if(this.danger) {
                    classes += '-danger'
                }
                console.log(classes);
                return classes;

            }
        }
    }
</script>

<style scoped>

</style>