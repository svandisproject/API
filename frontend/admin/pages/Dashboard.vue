<template lang="html">
  <section class="dashboard">
    <h1>dashboard Component</h1>
    <code>query: {{ query }}</code>
    <ui-card>
        <k-datatable v-bind="$data" resource="tag" />
    </ui-card>
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
              { title: 'User ID', field: 'uid', sortable: true, thComp: 'dt-text-filter'},
              { title: 'Username', field: 'name', thComp: 'dt-text-filter'},
              { title: 'Age', field: 'age', sortable: true },
              { title: 'Email', field: 'email', thComp: 'dt-text-filter' },
              { title: 'Country', field: 'country', thComp: 'dt-text-filter'}
          ],
          data: [
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
