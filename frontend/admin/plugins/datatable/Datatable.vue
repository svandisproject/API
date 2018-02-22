<template lang="html">
    <table class="uk-table uk-table-striped">
        <caption></caption>
        <thead>
            <tr>
                <th v-for="column in columns">
                    {{ column.label }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="row in list">
                <td v-for="(column, key) in columns">
                    <template v-if="column.type === 'timeago'">
                        <timeago v-if="row[key]" :since="row[key]" :auto-update="1"></timeago>
                        <span v-else>Never</span>
                    </template>
                    <template v-else>
                        {{ row[key] }}
                    </template>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script lang="js">
  import config from '../../config'

  export default  {
    name: 'k-datatable',
    props: {
      resource: {
          type: String,
          required: true
      },
      columns: {
          type: Object,
          validator: (columns) => {
            return true;
          }
      }
    },
    mounted() {
        this.$axios.get(config.API_URL + '/'+ this.resource)
            .then((response) => {
                this.list = response.data
            })
    },
    data() {
      return {
        list: []
      }
    },
    methods: {

    },
    computed: {

    }
}
</script>

<style scoped lang="stylus">
  .datatable {

  }
</style>
