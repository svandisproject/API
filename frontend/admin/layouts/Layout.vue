<template lang="html">
  <section class="layout">
    <ui-container size="large">
        <router-view v-show="!isLoading"></router-view>
        <preloader v-show="isLoading"></preloader>
    </ui-container>
  </section>
</template>

<script lang="js">
  import Preloader from '../components/Preloader.vue'
  import { mapGetters } from 'vuex'

  export default  {
    name: 'layout',
    computed: {
        ...mapGetters(['isLoading'])
    },
    components: {Preloader}
}
</script>
<style lang="scss" scoped>
    .layout {
        min-height: 100%;
    }
</style>