<template lang="html">
    <ui-navbar>
        <ul class="uk-navbar-nav" slot="left">
            <li><router-link to="/">Dashboard</router-link></li>
        </ul>
    </ui-navbar>
</template>

<script lang="js">
  export default  {
    name: 'navbar',
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
  .navbar {

  }
</style>
