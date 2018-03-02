<template lang="html">
    <section class="datatable">
        <datatable
        v-bind="$data"
        :columns="columns"
        :query="query"
        />
    </section>
</template>

<script lang="js">
  import config from '../../config'

  export default  {
    name: 'k-datatable',
    data () {
        return {
            data: [],
            total: 0,
            query: {
                limit: 10,
                offset: 0
            }
        }
    },
    props: {
        resource: {
            type: String,
            required: true
        },
        columns: { type: Array, required: true },
        HeaderSettings: { type: Boolean, default: true },
        Pagination: { type: Boolean, default: true },
        pageSizeOptions: { type: Array, default: () => [10, 20, 40, 80, 100] },
        tblClass: [String, Object, Array],
        tblStyle: [String, Object, Array],
        fixHeaderAndSetBodyMaxHeight: Number,
        supportNested: [Boolean, String],
        supportBackup: Boolean,
        filter: { type: Object , default: {}}
    },
    mounted() {
        for(let i in this.filter) {
            this.query[i] = this.filter[i];
        }
        this.getData(this.query)
    },
    watch: {
      query: {
          handler (query) {
              this.getData(query)
          },
          deep: true
      },
        filter: {
            handler (filter) {
                for(let i in this.filter) {
                    this.query[i] = this.filter[i];
                }
                this.getData(this.query)
            },
            deep: true
        }
    },
      methods: {
          getData(query) {
              let queryString = Object.entries(query).map(([key, val]) => val !== '' && typeof val !== 'undefined' ?
                  `${key}=${val}` : null).filter((val) => {return val}).join('&');
              this.$axios.get('/api/'+this.resource+'/filter?' + queryString)
                  .then((res) => {
                      this.data = res.data.rows;
                      this.total = parseInt(res.data.total);
                  })
          }
      },
      computed: {
        currentQuery: () => {
            return this.query;
        }
      }
  }
</script>

<style scoped lang="stylus">
  .datatable {

  }
</style>
