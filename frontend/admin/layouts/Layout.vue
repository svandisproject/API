<template lang="html">
  <section class="layout">
    <ui-container>
        <router-view v-if="!loading"></router-view>
        <preloader v-if="loading"></preloader>
    </ui-container>
  </section>
</template>

<script lang="js">
  import Preloader from '../components/Preloader.vue'
  import { mapGetters } from 'vuex'

  export default  {
    name: 'layout',
    computed: {
        ...mapGetters(['loading'])
    },
    components: {Preloader}
}
</script>
