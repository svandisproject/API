<template lang="html">
    <section class="worker-settings">
        <h2>Tags <ui-button @click.native="$router.push({name: 'tag_new'})" primary>New</ui-button></h2>
        <ui-card>
            <k-datatable resource="tag" :columns="getColumns()"/>
        </ui-card>
    </section>
</template>

<script lang="js">

    export default {
        name: 'tag-list',
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
