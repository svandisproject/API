<template lang="html">
    <section class="worker-settings">
        <div uk-grid>
            <ui-tab position="left" class="uk-width-1-6">
                <router-link tag="li" active-class="uk-active" :to="{name: 'tags'}"><a><ui-icon i="server" />&nbsp;Taglist</a></router-link>
            </ui-tab>
            <div class="feed uk-width-5-6">
                <router-view></router-view>
            </div>
        </div>
    </section>
</template>

<script lang="js">
    export default  {
        name: 'tags',
        methods: {
            getColumns() {
                return [
                    { title: 'Title', field: 'title', sortable: true},
                    { title: 'Actions', tdComp: 'table-actions'},
                ]
            }
        }
    }
</script>

<style scoped lang="scss">
</style>