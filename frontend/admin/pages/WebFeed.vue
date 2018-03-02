<template lang="html">
    <section class="webfeeds">
        <ui-tab>
            <router-link tag="li" active-class="uk-active" :to="{name: 'web-feed', params: {id: 1}}"><a><ui-icon i="world" />&nbsp;Coindesk</a></router-link>
            <router-link tag="li" active-class="uk-active" :to="{name: 'web-feed', params:{id: 2}}"><a><ui-icon i="world" />&nbsp;Cointelegraph</a></router-link>

        </ui-tab>
    <router-view></router-view>
    </section>
</template>
<style scoped lang="scss">

</style>
<script lang="js">
    export default  {
        name: 'web-feed',
    }
</script>