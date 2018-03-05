<template>
  <span name="PageSizeSelect" class="uk-label">
     <select class="uk-select uk-form-width-xsmall" v-model="query.limit"
             @change="query.offset = 0 /* reset to the first page */">
      <option v-for="i in pageSizeOptions" :value="i">{{ i }}</option>
     <span>{{ $i18nForDatatable('items / page') }}</span>
    </select>
    {{ $i18nForDatatable('items / page') }}
</span>
</template>
<script>
export default {
  name: 'PageSizeSelect',
  props: {
    query: { type: Object, required: true },
    pageSizeOptions: { type: Array, required: true }
  }
}
</script>
<style>
.-page-size-select {
  display: inline-block;
  width: 65px;
}
</style>
