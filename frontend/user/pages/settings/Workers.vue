<template lang="html">
  <section class="worker-settings">
    <h2>Workers</h2>
    <worker-code />
    <h2>Registered workers</h2>
    <ui-card>
        <k-datatable resource="worker" :columns="getColumns()"/>
    </ui-card>
  </section>
</template>

<script lang="js">
  import WorkerCode from '../../components/WorkerCode'

  export default  {
    name: 'workers',
    methods: {
      getColumns() {
        return [
            { title: 'Id', field: 'id', sortable: true},
            { title: 'Host', field: 'host', sortable: true},
            { title: 'Last seen', field: 'last_seen_at', tdComp: 'table-timeago',  sortable: true},
        ]
      }
    },
    components: {
        WorkerCode
    }
}
</script>

<style scoped lang="scss">
</style>
