<template lang="html">
    <section class="worker-settings">
        <h2>Reddit feeds <ui-button @click.native="$router.push({name: 'settings_reddit_feed_new'})" primary>New</ui-button></h2>
        <ui-card>
            <k-datatable resource="reddit-feed" :columns="getColumns()"/>
        </ui-card>
    </section>
</template>

<script lang="js">
    export default  {
        name: 'reddit-feeds',
        methods: {
            getColumns() {
                return [
                    { title: 'User name', field: 'user_name', sortable: true},
                    { title: 'User password', field: 'user_password', sortable: true},
                    { title: 'Time Interval', field: 'time_interval', sortable: true},
                    { title: 'Actions', tdComp: 'table-actions'}
                ]
            }
        }
    }
</script>

<style scoped lang="scss">
</style>