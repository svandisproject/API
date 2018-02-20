<template lang="html">

  <section class="feeds" uk-grid>
      <ui-tab position="left" class="uk-width-1-6">
        <li><router-link :to="{name: 'feeds_web'}"><ui-icon i="world" />&nbsp;Web feeds</router-link></li>
        <li><router-link :to="{name: 'feeds_facebook'}"><ui-icon i="facebook" />&nbsp;Facebook feeds</router-link></li>
        <li><router-link :to="{name: 'feeds_twitter'}"><ui-icon i="twitter" />&nbsp;Twitter feeds</router-link></li>
      </ui-tab>
      <div class="feed uk-width-5-6">
        <router-view></router-view>
      </div>
  </section>

</template>

<script lang="js">
  import WebFeed from '../components/WebFeed'
  export default  {
    name: 'feeds',
    props: [],
    mounted() {

    },
    data() {
      return {

      }
    },
    methods: {

    },
    components: {
        WebFeed
    }
}
</script>

<style scoped lang="stylus">
  .feeds {
    .feed {
        padding-left 2rem;
    }
  }
</style>
