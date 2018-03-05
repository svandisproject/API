<template lang="html">

 <div :class="getClass()">
    <slot></slot>
 </div>

</template>

<script lang="js">
  export default  {
    name: 'ui-position',
      props: {
          'top': {type: Boolean, default: false},
          'bottom': {type: Boolean, default: false},
          'left': {type: Boolean, default: false},
          'right': {type: Boolean, default: false},
          'center': {type: Boolean, default: true},
          'out': {type: Boolean, default: false},
          'small': {type: Boolean, default: false},
          'medium': {type: Boolean, default: false},
          'large': {type: Boolean, default: false},
          'relative': {type: Boolean, default: false},
          'absolute': {type: Boolean, default: false},
          'fixed': {type: Boolean, default: false},
          'zIndex': {type: Boolean, default: false},

    },
    methods: {
        getClass() {
            if(this.top && this.bottom) {
                throw new Error('Position is unevident. You can not declare both top and bottom properties')
            }
            if(this.left && this.right) {
                throw new Error('Position is unevident. You can not declare both left and right properties')
            }
            if(this.small && this.medium || this.small && this.large || this.medium && this.large) {
                throw new Error('Position is unevident. You can not declare small, medium and large properties together')
            }
            if(this.relative && this.absolute || this.relative && this.fixed || this.fixed && this.absolute) {
                throw new Error('Position is unevident. You can not declare relative, absolute and fixed properties together')
            }

            let classes = 'uk-position';
            if(this.center) {
                classes += '-center'
            }
            if(this.top) {
                classes += '-top'
            }
            if(this.left) {
                classes += '-left'
            }
            if(this.right) {
                classes += '-right'
            }
            if(this.bottom) {
                classes += '-bottom'
            }
            if(this.out) {
                classes += '-out'
            }
            if(this.small) {
                classes += ' uk-position-small'
            }
            if(this.medium) {
                classes += ' uk-position-medium'
            }
            if(this.large) {
                classes += ' uk-position-large'
            }
            if(this.relative) {
                classes += ' uk-position-relative'
            }
            if(this.absolute) {
                classes += ' uk-position-absolute'
            }
            if(this.fixed) {
                classes += ' uk-position-fixed'
            }
            if(this.zIndex) {
                classes += ' uk-position-z-index'
            }

            return classes;
        }
    }
}
</script>
