<template lang="html">
    <ui-navbar>
        <ul class="uk-navbar-nav" slot="left">
            <li><router-link to="/">Dashboard</router-link></li>
            <li><router-link to="/feeds">Feeds</router-link></li>
        </ul>
        <ul class="uk-navbar-nav" slot="right">
            <li><k-logout /></li>
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
