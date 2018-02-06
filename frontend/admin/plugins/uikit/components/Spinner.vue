<template lang="html">
 <div uk-spinner v-if="show"></div>
</template>
<script lang="js">
  export default  {
    name: 'ui-spinner',
    props: {'show':{type: Boolean, default: true}}
}
</script>