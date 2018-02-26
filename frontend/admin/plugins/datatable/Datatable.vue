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
        data: { type: Array, required: true }, // rows
        total: { type: Number, required: true },
        query: { type: Object, required: true },
        selection: Array, // container for multi-select
        summary: Object, // an extra summary row
        xprops: Object, // extra custom props carrier passed to dynamic components
        HeaderSettings: { type: Boolean, default: true }, // whether to render `HeaderSettings`
        Pagination: { type: Boolean, default: true }, // whether to render `PageSizeSelect` and `Pagination`
        pageSizeOptions: { type: Array, default: () => [10, 20, 40, 80, 100] },
        tblClass: [String, Object, Array], // classes for <table>
        tblStyle: [String, Object, Array], // inline styles for <table>
        fixHeaderAndSetBodyMaxHeight: Number, // a fancy prop which combines two props into one
        supportNested: [Boolean, String], // support nested components feature (String is only for 'accordion')
        supportBackup: Boolean // support backup for `HeaderSettings`
    },
    mounted() {
    }
  }
</script>

<style scoped lang="stylus">
  .datatable {

  }
</style>
