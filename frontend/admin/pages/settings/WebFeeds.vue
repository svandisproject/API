<template lang="html">
  <section class="worker-settings">
    <h2>Web feeds <ui-button @click.native="$router.push({name: 'settings_web_feeds_new'})" primary>New</ui-button></h2>
    <ui-card>
        <k-datatable resource="web-feed" :columns="getColumns()"/>
    </ui-card>
  </section>
</template>

<script lang="js">
  export default  {
    name: 'web-feeds',
    methods: {
      getColumns() {
        return [
            { title: 'Title', field: 'title', sortable: true},
            { title: 'Title selector', field: 'title_selector', sortable: true},
            { title: 'Content selector', field: 'content_selector', sortable: true},
            { title: 'Published at selector', field: 'published_at_selector', sortable: true},
            { title: 'Date format', field: 'date_format', sortable: true},
            { title: 'Actions', tdComp: 'table-actions'},
        ]
      }
    }
}
</script>

<style scoped lang="scss">
</style>
