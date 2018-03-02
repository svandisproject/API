<template lang="html">
    <k-datatable resource="website-post" :columns="getColumns()" v-bind:filter="filter"></k-datatable>
</template>
<style scoped lang="scss">

</style>
<script lang="js">
    export default  {
        name: 'web-feed',
        methods: {
            getColumns() {
                return [
                    { title: 'Id', field: 'id', sortable: true},
                    { title: 'Title', field: 'title', sortable: true, thComp: 'dt-text-filter'},
                    { title: 'Published At', field: 'published_at', tdComp: 'table-timeago',  sortable: true},
                    { title: 'Created At', field: 'created_at', tdComp: 'table-timeago',  sortable: true},
                ];
            },
        },
        computed: {
            filter() {
                if(this.$route.params.id == '1') {
                    return {'source': 'coindesk'};
                } else {
                    return {'source': 'cointelegraph'};
                }
            }
        }
//        mounted() {
//            this.query.source = 'coindesk'
//        }
    }
</script>