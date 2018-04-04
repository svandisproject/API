<template lang="html">
  <section class="settings">
    <div uk-grid>
        <ui-tab position="left" class="uk-width-1-6">
          <router-link tag="li" active-class="uk-active" :to="{name: 'settings_workers'}"><a><ui-icon i="server" />&nbsp;Workers</a></router-link>
          <router-link tag="li" active-class="uk-active" :to="{name: 'settings_web_feeds'}"><a><ui-icon i="world" />&nbsp;Web Feeds</a></router-link>
          <router-link tag="li" active-class="uk-active" :to="{name: 'settings_facebook_users'}"><a><ui-icon i="world" />&nbsp;Facebook Users</a></router-link>
          <router-link tag="li" active-class="uk-active" :to="{name: 'settings_twitter_users'}"><a><ui-icon i="world" />Twitter Users</a></router-link>
          <router-link tag="li" active-class="uk-active" :to="{name: 'settings_reddit_feeds'}"><a><ui-icon i="world" />Reddit Feeds</a></router-link>
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
