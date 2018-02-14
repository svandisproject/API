<template lang="html">
  <section class="dashboard">
    <h1>dashboard Component</h1>
    <k-logout></k-logout>


  </section>
</template>

<script lang="js">
  export default  {
    name: 'dashboard',
    props: [],
    mounted() {
        this.$axios.post('/hello-world', {some: 'data'});
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
