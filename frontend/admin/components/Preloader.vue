<template lang="html">

  <div class="preloader" v-if="loading">
    <ui-position center>
        We are loading <ui-spinner></ui-spinner>
    </ui-position>
  </div>
</template>

<script lang="js">
  import { mapGetters } from 'vuex'

  export default  {
    name: 'k-preloader',
    computed: {
        ...mapGetters(['loading'])
    }
}
</script>

<style scoped lang="scss">
  .preloader {

  }
</style>
