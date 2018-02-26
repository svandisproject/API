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
              {
                  uid: 123,
                  name: 'John Doe',
                  age: 45,
                  email: 'test@test.com',
                  country: 'Ukraine'
              },
              {
                  uid: 123,
                  name: 'John Doe',
                  age: 45,
                  email: 'test@test.com',
                  country: 'Ukraine'
              },
              {
                  uid: 123,
                  name: 'John Doe',
                  age: 45,
                  email: 'test@test.com',
                  country: 'Ukraine'
              },
              {
                  uid: 123,
                  name: 'John Doe',
                  age: 45,
                  email: 'test@test.com',
                  country: 'Ukraine'
              },
              {
                  uid: 123,
                  name: 'John Doe',
                  age: 45,
                  email: 'test@test.com',
                  country: 'Ukraine'
              },
              {
                  uid: 123,
                  name: 'John Doe',
                  age: 45,
                  email: 'test@test.com',
                  country: 'Ukraine'
              },
              {
                  uid: 123,
                  name: 'John Doe',
                  age: 45,
                  email: 'test@test.com',
                  country: 'Ukraine'
              },
              {
                  uid: 123,
                  name: 'John Doe',
                  age: 45,
                  email: 'test@test.com',
                  country: 'Ukraine'
              },
              {
                  uid: 123,
                  name: 'John Doe',
                  age: 45,
                  email: 'test@test.com',
                  country: 'Ukraine'
              },
              {
                  uid: 123,
                  name: 'John Doe',
                  age: 45,
                  email: 'test@test.com',
                  country: 'Ukraine'
              },
              {
                  uid: 123,
                  name: 'John Doe',
                  age: 45,
                  email: 'test@test.com',
                  country: 'Ukraine'
              },
              {
                  uid: 123,
                  name: 'John Doe',
                  age: 45,
                  email: 'test@test.com',
                  country: 'Ukraine'
              },
              {
                  uid: 123,
                  name: 'John Doe',
                  age: 45,
                  email: 'test@test.com',
                  country: 'Ukraine'
              },
              {
                  uid: 123,
                  name: 'John Doe',
                  age: 45,
                  email: 'test@test.com',
                  country: 'Ukraine'
              },
          ],
          total: 99,
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
