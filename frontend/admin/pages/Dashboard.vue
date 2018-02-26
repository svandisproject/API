<template lang="html">
  <section class="dashboard">
    <h1>dashboard Component</h1>
    <code>query: {{ query }}</code>
    <datatable v-bind="$data" />
    <ui-pagination flexCenter></ui-pagination>
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
              { title: 'User ID', field: 'uid', sortable: true },
              { title: 'Username', field: 'name' },
              { title: 'Age', field: 'age', sortable: true },
              { title: 'Email', field: 'email' },
              { title: 'Country', field: 'country' }
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
