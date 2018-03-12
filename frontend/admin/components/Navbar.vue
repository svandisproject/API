<template lang="html">
    <ui-navbar>
    <router-link :to="{name: 'dashboard'}" class="uk-navbar-item uk-logo" slot="logo">
        <logo></logo>
    </router-link>
   <ul class="uk-navbar-nav" slot="left">
        <li><router-link :to="{name: 'dashboard'}">Dashboard</router-link></li>
        <li><router-link :to="{name: 'feeds'}">Feeds</router-link></li>
        <li><router-link :to="{name: 'tags'}">Tags</router-link></li>
    </ul>

    <ul class="uk-navbar-nav" slot="right">
        <li v-if="$auth.hasRole('ROLE_ADMIN')">
            <router-link :to="{name: 'settings'}"><ui-icon i="settings" />&nbsp;Settings</router-link>
        </li>
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
