<template lang="html">
  <section class="settings">
    <div uk-grid>
        <ui-tab position="left" class="uk-width-1-6">
          <li><router-link :to="{name: 'settings_workers'}"><ui-icon i="server" />&nbsp;Workers</router-link></li>
        </ui-tab>
        <div class="feed uk-width-5-6">
            <router-view></router-view>
        </div>
    </div>
  </section>
</template>

<script lang="js">
  export default  {
    name: 'settings',
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
