<template lang="html">
  <section class="dashboard">
    <h1>dashboard Component</h1>
    <ui-card>
        <k-datatable :columns="getColumns()" resource="tag" />
    </ui-card>
  </section>
</template>

<script lang="js">
  export default  {
    name: 'dashboard',
    props: [],
    methods: {
        getColumns() {
           return [
               { title: 'Id', field: 'id', sortable: true},
               { title: 'Title', field: 'title', thComp: 'dt-text-filter'},
           ]
        }
    }
}
</script>

<style scoped lang="stylus">
  .dashboard {

  }
</style>
