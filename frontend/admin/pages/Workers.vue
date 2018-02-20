<template lang="html">
  <section class="worker-settings">
    <h2>Workers</h2>
    <worker-code />
    <h2>Registered workers</h2>
    <ui-card>
        <k-datatable resource="worker" :columns="columns"/>
    </ui-card>
  </section>
</template>

<script lang="js">
  import WorkerCode from '../components/WorkerCode'

  export default  {
    name: 'workers',
    props: [],
    mounted() {
    },
    data() {
      return {
        columns: {
            host: {
                label: 'Host',
                type: 'string',
                filter: {
                    type: 'string'
                },
                sortable: true
            },
            last_seen_at: {
                label: 'Last seen',
                type: 'timeago',
                filter: {
                    type: 'daterange'
                },
                sortable: true
            }
        }
      }
    },
    methods: {

    },
    computed: {

    },
    components: {
        WorkerCode
    }
}
</script>

<style scoped lang="scss">
</style>
