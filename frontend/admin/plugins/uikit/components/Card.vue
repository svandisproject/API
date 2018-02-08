<template lang="html">
 <div :class="{'uk-card': true,
               'uk-card-small': size === 'small',
               'uk-card-large': size === 'large',
               'uk-card-default': variant === 'default',
               'uk-card-primary': variant === 'primary',
               'uk-card-secondary': variant === 'secondary',
               'uk-card-hover': hover
  }">
    <div class="uk-card-header" v-if="$slots['header']">
        <slot name="header"></slot>
    </div>
    <div class="uk-card-media-top" v-if="$slots['media-top']">
        <slot name="media-top"></slot>
    </div>
    <div class="uk-card-body">
        <slot></slot>
    </div>
    <slot name="badge"></slot>
    <div class="uk-card-media-bottom" v-if="$slots['media-bottom']">
        <slot name="media-bottom"></slot>
    </div>
    <div class="uk-card-footer" v-if="$slots['footer']">
        <slot name="footer"></slot>
    </div>
 </div>
</template>
<script lang="js">
  export default  {
    name: 'ui-card',
    props: {
        'size': {
            type: String,
            default: 'regular',
            validator: (value) => {
                return ['small', 'large', 'regular'].indexOf(value) > -1
            },
        },
        'variant': {
            type: String,
            default: 'default',
            validator: (value) => {
                return ['default', 'primary', 'secondary'].indexOf(value) > -1
            },
        },
        'horizontal': {
            type: Boolean,
            default: false,
        },
        'hover': {
            type: Boolean,
            default: false,
        },
    },
}
</script>