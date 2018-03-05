<template lang="html">
    <ui-navbar>
    <router-link :to="{name: 'dashboard'}" class="uk-navbar-item uk-logo" slot="logo">
        <logo></logo>
    </router-link>
   <ul class="uk-navbar-nav" slot="left">
        <li><router-link :to="{name: 'dashboard'}">Dashboard</router-link></li>
        <li><router-link to="#">ICO screener</router-link></li>
        <li><router-link to="#">Alt Coins screener</router-link></li>
        <li><router-link to="#">Index Builder</router-link></li>
        <li><router-link to="#">Visualisation tools</router-link></li>
        <li><router-link to="#">Market caps</router-link></li>
        <li><router-link to="#">Data marketplace</router-link></li>
    </ul>
    <ul class="uk-navbar-nav" slot="right">
        <li><k-logout /></li>
    </ul>
    </ui-navbar>
</template>

<script lang="js">
  import Logo from './Logo'
  export default  {
    name: 'navbar',
    components: { Logo }
}
</script>

<style scoped lang="scss">
  .uk-navbar {
    margin-bottom: 2rem;
  }
</style>
