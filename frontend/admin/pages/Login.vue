<template lang="html">

  <section class="login">
    <ui-position center small>
        <ui-card size="small">
            <h3 class="uk-card-title" slot="header"><logo/> Login</h3>
            <k-login></k-login>
        </ui-card>
    </ui-position>
  </section>

</template>

<script lang="js">
  import Logo from '../components/Logo'
  export default  {
    name: 'login',
    components: {Logo}
  }
</script>
<style lang="scss" scoped>
    .uk-card-title {
        svg.logo {
            height: 1.5rem;
        }
    }
</style>