<template lang="html">
    <datatable
    :columns="columns"
    :data="data"
    :total="total"
    :query="query"
    :selection="selection"
    :summary="summary"
    :xprops="xprops"
    :HeaderSettings="HeaderSettings"
    :Pagination="Pagination"
    :pageSizeOptions="pageSizeOptions"
    :tblClass="tblClass"
    :tblStyle="tblStyle"
    :fixHeaderAndSetBodyMaxHeight="fixHeaderAndSetBodyMaxHeight"
    :supportNested="supportNested"
    :supportBackup="supportBackup" />
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
        columns: { type: Array, required: true },
        data: { type: Array, required: true },
        total: { type: Number, required: true },
        query: { type: Object, required: true },
        selection: Array,
        summary: Object,
        xprops: Object,
        HeaderSettings: { type: Boolean, default: true },
        Pagination: { type: Boolean, default: true },
        pageSizeOptions: { type: Array, default: () => [10, 20, 40, 80, 100] },
        tblClass: [String, Object, Array],
        tblStyle: [String, Object, Array],
        fixHeaderAndSetBodyMaxHeight: Number,
        supportNested: [Boolean, String],
        supportBackup: Boolean
    },
    mounted() {
    },
    watch: {
      query: {
          handler (query) {
              let queryString = Object.entries(query).map(([key, val]) => val !== '' && typeof val !== 'undefined' ?
                  `${key}=${val}` : null).filter((val) => {return val}).join('&');
              this.$axios.get('/api/'+this.resource+'/filter?' + queryString)
                  .then((res) => {
                      this.data = res.data.rows;
                      this.total = parseInt(res.data.total);
                  })
          },
          deep: true
      }
  },

  }
</script>

<style scoped lang="stylus">
  .datatable {

  }
</style>
