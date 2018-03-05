<template lang="html">
 <div :class="{'uk-container': true,
               'uk-container-small': size === 'small',
               'uk-container-large': size === 'large',
               'uk-container-expand': size === 'expand'
  }">
  <slot></slot>
 </div>
</template>
<script lang="js">
  export default  {
    name: 'ui-container',
    props: {'size':{
        type: String,
        default: 'regular',
        validator: (value) => {
            return ['small', 'large', 'expand', 'regular'].indexOf(value) > -1
        }
    }}
}
</script>