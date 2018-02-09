<template lang="html">
  <section class="dashboard">
    <h1>dashboard Component</h1>
    <k-logout></k-logout>
    <ui-spinner :show="true"></ui-spinner>
    <ui-position center relative><p>Hello</p></ui-position>
    <p>Slider nav section</p>
    <ui-slider-nav overlay large></ui-slider-nav>
    <p>End Slider nav section</p>
    <uk-accordion notCollapsible multiple></uk-accordion>
  </section>
</template>

<script lang="js">
  export default  {
    name: 'dashboard',
    props: [],
    mounted() {

    },
    data() {
      return {

      }
    },
    methods: {

    },
    computed: {

    }
}
</script>

<style scoped lang="stylus">
  .dashboard {

  }

</style>
