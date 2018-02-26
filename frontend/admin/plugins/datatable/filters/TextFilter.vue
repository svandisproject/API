<template>
  <div class="uk-inline">
    <span class="filterable">{{title}}</span>
    <div uk-drop="mode: click; pos: bottom">
      <ui-card size="small">
        <div class="uk-inline uk-width-1-1">
          <a class="uk-form-icon uk-form-icon-flip" @click="search" uk-icon="icon: search"></a>
          <input class="uk-input uk-form-small"
                 v-model="keyword"
                 @keydown.enter="search"
                 :placeholder="`Search ${field}...`">
        </div>
      </ui-card>
    </div>
  </div>
</template>
<script>
export default {
  name: 'dt-text-filter',
  props: ['field', 'title', 'query'],
  data: () => ({
    keyword: ''
  }),
  mounted () {
//    $(this.$el).on('shown.bs.dropdown', e => this.$refs.input.focus())
  },
  watch: {
    keyword (kw) {
      // reset immediately if empty
      if (kw === '') this.search()
    }
  },
  methods: {
    search () {
      const { query } = this
      // `$props.query` would be initialized to `{ limit: 10, offset: 0, sort: '', order: '' }` by default
      // custom query conditions must be set to observable by using `Vue.set / $vm.$set`
      this.$set(query, this.field, this.keyword)
      query.offset = 0 // reset pagination
    }
  }
}
</script>
<style>
input[type=search]::-webkit-search-cancel-button {
  -webkit-appearance: searchfield-cancel-button;
  cursor: pointer;
}
</style>
