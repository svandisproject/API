<template lang="html">
  <section class="dashboard">
    <h1>dashboard Component</h1>
    <code>query: {{ query }}</code>
    <k-datatable v-bind="$data" resource="tag" />
  </section>
</template>

<script lang="js">
  export default  {
    name: 'dashboard',
    props: [],
    mounted() {
    },
    data() {
      return {
          columns: [
              { title: 'Id', field: 'id', sortable: true, thComp: 'dt-text-filter' },
              { title: 'Title', field: 'title', sortable: true, thComp: 'FilterTh' }
          ],
          data: [
              {
                  id: 123,
                  title: 'John Doe'
              },
          ],
          total: 1,
          query: {}
      }
    },
    methods: {

    },
    computed: {

    }
}
</script>

<style scoped lang="stylus">
  .dashboard {

  }
</style>
