<template lang="html">
    <section class="webfeeds">
        <ui-tab>
            <template v-for="feed in feeds">
                <router-link tag="li" active-class="uk-active" :to="{name: 'web-feed', params: {id: feed.title}}"><a><ui-icon i="world" />&nbsp;{{feed.title}}</a></router-link>
            </template>
        </ui-tab>
    <router-view></router-view>
    </section>
</template>
<style scoped lang="scss">

</style>
<script lang="js">
    import config from '../config';
    export default  {
        name: 'web-feed',
        data() {
            return {
                feeds: []
            }
        },
        mounted() {
            this.$axios.get(config.API_URL + '/web-feed')
                .then((response) => {
                    this.feeds = response.data
                })
        }
    }
</script>