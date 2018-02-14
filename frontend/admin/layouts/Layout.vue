<template lang="html">
  <section class="layout">
    <navbar />
    <ui-container size="large">
        <router-view v-show="!isLoading"></router-view>
        <preloader v-show="isLoading"></preloader>
        <notifications position="top center" group="auth"/>
    </ui-container>
  </section>
</template>

<script lang="js">
  import Preloader from '../components/Preloader.vue'
  import { mapGetters } from 'vuex'
  import Navbar from '../components/Navbar'

  export default  {
    name: 'layout',
    computed: {
        ...mapGetters(['isLoading'])
    },
    components: {Preloader, Navbar}
}
</script>
<style lang="scss" scoped>
    .layout {
        min-height: 100%;
    }
</style>