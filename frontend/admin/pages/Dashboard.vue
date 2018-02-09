<template lang="html">
  <section class="dashboard">
    <h1>dashboard Component</h1>
    <k-logout></k-logout>
    <ui-navbar-wrap>
      <navbar-container-position>
        <navbar-container-position-list></navbar-container-position-list>
    </navbar-container-position>
    </ui-navbar-wrap>
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
