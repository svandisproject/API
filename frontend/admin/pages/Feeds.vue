<template lang="html">

  <section class="feeds" uk-grid>
      <ui-tab position="left" class="uk-width-1-6">
        <router-link tag="li" active-class="uk-active" :to="{name: 'feeds_web'}"><a><ui-icon i="world" />&nbsp;Web feeds</a></router-link>
        <router-link tag="li" active-class="uk-active"  :to="{name: 'feeds_facebook'}"><a><ui-icon i="facebook" />&nbsp;Facebook feeds</a></router-link>
        <router-link tag="li" active-class="uk-active"  :to="{name: 'feeds_twitter'}"><a><ui-icon i="twitter" />&nbsp;Twitter feeds</a></router-link>
        <router-link tag="li" active-class="uk-active"  :to="{name: 'website_posts'}"><a><ui-icon i="twitter" /> Website posts</a></router-link>
      </ui-tab>
      <div class="feed uk-width-5-6">
        <router-view></router-view>
      </div>
  </section>

</template>

<script lang="js">
  export default  {
    name: 'feeds'
}
</script>

<style scoped lang="stylus">
  .feeds {
    .feed {
        padding-left 2rem;
    }
  }
</style>
