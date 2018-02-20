<template>
    <div :class="getClass()">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        name: 'ui-padding',
        props: {
            'padding': {type: Boolean, default: true},
            'small': {type: Boolean, default: false},
            'large': {type: Boolean, default: false},
            'remove': {type: Boolean, default: false},
            'removeTop': {type: Boolean, default: false},
            'removeBottom': {type: Boolean, default: false},
            'removeLeft': {type: Boolean, default: false},
            'removeRight': {type: Boolean, default: false},
            'removeVertical': {type: Boolean, default: false},
            'removeHorizontal': {type: Boolean, default: false}
        },
        methods:{
            getClass(){
                if(this.small && this.large || this.small && this.remove || this.small && this.removeTop || this.small && this.removeBottom || this.small && this.removeLeft ||
                   this.small && this.removeRight || this.small && this.removeVertical || this.small && this.removeHorizontal ||
                   this.large && this.remove || this.large && this.removeTop || this.large && this.removeBottom || this.large && this.removeLeft ||
                   this.large && this.removeRight || this.large && this.removeVertical || this.large && this.removeHorizontal ||
                   this.remove && this.removeTop ||  this.remove && this.removeBottom || this.remove && this.removeLeft || this.remove && this.removeRight ||
                   this.remove && this.removeVertical || this.remove && this.removeHorizontal || this.removeTop && this.removeLeft ||
                   this.removeTop && this.removeRight || this.removeTop && this.removeVertical || this.removeTop && this.removeHorizontal||
                   this.removeBottom && this.removeLeft || this.removeBottom && this.removeRight || this.removeBottom && this.removeVertical ||
                   this.removeBottom && this.removeHorizontal || this.removeLeft && this.removeRight || this.removeLeft && this.removeVertical ||
                   this.removeLeft && this.removeHorizontal || this.removeRight && this.removeVertical || this.removeRight && this.removeHorizontal ||
                   this.removeVertical && this.removeHorizontal){
                    throw new Error('Inverse the padding is unevident. You can not declare more one properties')
                }
                let classes;
                if(this.small){
                    classes = 'uk-padding-small';
                }
                if(this.large){
                    classes = 'uk-padding-large';
                }
                if(this.remove){
                    classes = 'uk-padding-remove';
                }
                if(this.removeTop){
                    classes = 'uk-padding-remove-top';
                }
                if(this.removeLeft){
                    classes = 'uk-padding-remove-left';
                }
                if(this.removeRight){
                    classes = 'uk-padding-remove-right';
                }
                if(this.removeVertical){
                    classes = 'uk-padding-remove-vertical';
                }
                if(this.removeHorizontal){
                    classes = 'uk-padding-remove-horizontal';
                }
                return classes;
            }
        }
    }
</script>

<style scoped>

</style>