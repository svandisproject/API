<template lang="html">
    <section class="worker-settings">
        <h2>Twitter Users <ui-button @click.native="$router.push({name: 'settings_twitter_users_new'})" primary>New</ui-button></h2>
        <ui-card>
            <k-datatable resource="twitter-user" :columns="getColumns()"/>
        </ui-card>
    </section>
</template>

<script lang="js">
    export default  {
        name: 'twitter-users',
        methods: {
            getColumns() {
                return [
                    { title: 'Mode', field: 'mode', sortable: true},
                    { title: 'Consumer Key', field: 'consumer_key', sortable: true},
                    { title: 'Consumer Secret', field: 'consumer_secret', sortable: true},
                    { title: 'Access Token Key', field: 'access_token_key', sortable: true},
                    { title: 'Access Token Secret', field: 'access_token_secret', sortable: true},
                    { title: 'Time Interval', field: 'time_interval', sortable: true},
                    { title: 'accessTokenKey', tdComp: 'table-actions'},
                ]
            }
        }
    }
</script>

<style scoped lang="scss">
</style>