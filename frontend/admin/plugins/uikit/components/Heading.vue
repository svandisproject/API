<template>
    <h1 :class="getClass()">
        <slot></slot>
    </h1>
</template>

<script>
    export default {
        name: 'ui-heading',
        props: {
            'primary':  {type: Boolean, default: false},
            'hero':     {type: Boolean, default: false},
            'divider':  {type: Boolean, default: false},
            'bullet':   {type: Boolean, default: false},
            'line':     {type: Boolean, default: false}
        },
        methods: {
            getClass(){
                if(this.primary && this.hero || this.primary && this.divider || this.primary && this.bullet || this.primary && this.line ||
                   this.hero && this.divider || this.hero && this.bullet || this.hero && this.line || this.divider && this.bullet || this.divider && this.line ||
                   this.bullet && this.line){
                    throw new Error('Heading alternative styling is unevident. You can not declare more one properties')
                }
                let classes= 'uk-heading';
                if(this.primary){
                    classes += '-primary'
                }
                if(this.hero){
                    classes +='-hero';
                }
                if(this.divider){
                    classes +='-divider';
                }
                if(this.bullet){
                    classes +='-bullet';
                }
                if(this.line){
                    classes +='-line';
                }
                return classes;
            }
        }
    }
</script>

<style scoped>

</style>