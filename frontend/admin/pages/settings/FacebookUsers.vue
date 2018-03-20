<template lang="html">
    <section class="worker-settings">
        <h2>Facebook Users <ui-button @click.native="$router.push({name: 'settings_facebook_users_new'})" primary>New</ui-button></h2>
        <ui-card>
            <k-datatable resource="facebook-user" :columns="getColumns()"/>
        </ui-card>
    </section>
</template>

<script lang="js">
    export default  {
        name: 'facebook-users',
        methods: {
            getColumns() {
                return [
                    { title: 'Email', field: 'email', sortable: true},
                    { title: 'Password', field: 'password', sortable: true},
                    { title: 'Interval', field: 'time_interval', sortable: true},
                    { title: 'Actions', tdComp: 'table-actions'},
                ]
            }
        }
    }
</script>

<style scoped lang="scss">
</style>