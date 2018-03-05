<template lang="html">
  <section class="layout">
    <navbar v-if="$auth.authenticated()"/>
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
  import Logo from '../components/Logo'

  export default  {
    name: 'layout',
    computed: {
        ...mapGetters(['isLoading'])
    },
    components: {Preloader, Navbar, Logo}
}
</script>
<style lang="scss" scoped>
    .layout {
        min-height: 100%;
    }
</style>