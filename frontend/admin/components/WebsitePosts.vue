<template lang="html">
  <section class="worker-settings">
    <ui-card>
        <k-datatable resource="website-post" :columns="getColumns()"/>
    </ui-card>
  </section>
</template>

<script lang="js">
  export default  {
    name: 'website-posts',
    methods: {
      getColumns() {
        return [
            { title: 'Title', field: 'title', sortable: true},
            { title: 'Url', field: 'url', sortable: true},
            { title: 'Content', field: 'content', sortable: true},
            { title: 'Source', field: 'source', sortable: true},
            { title: 'Published At', field: 'published_at', sortable: true},
            { title: 'Actions', tdComp: 'table-actions'},
        ]
      }
    }
}
</script>

<style scoped lang="scss">
</style>
