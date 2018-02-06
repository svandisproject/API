<template lang="html">
 <div uk-spinner v-if="show"></div>
</template>
<script lang="js">
  export default  {
    name: 'ui-spinner',
    data() {
      return {
        show: true
      }
    },
    props: ['show']
}
</script>