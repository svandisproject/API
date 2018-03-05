<template>
  <div class="uk-inline">
    <button class="uk-button uk-button-text">{{title}}</button>
    <div uk-drop="mode: click; pos: bottom" class="filter" ref="drop">
      <ui-card size="small">
        <div class="uk-inline uk-width-1-1">
          <a class="uk-form-icon uk-form-icon-flip" @click="search" uk-icon="icon: search"></a>
          <input class="uk-input uk-form-small"
                 ref="input"
                 v-model="keyword"
                 @keydown.enter="search"
                 :placeholder="`Search ${field}...`">
        </div>
      </ui-card>
    </div>
  </div>
</template>
<script>
import UIkit from 'uikit'

export default {
  name: 'dt-text-filter',
  props: ['field', 'title', 'query'],
  data: () => ({
    keyword: ''
  }),
  mounted () {
      let input = this.$refs.input;
      UIkit.util.on(this.$refs.drop, 'show', () => {
          input.focus()
      })
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
      UIkit.drop(this.$refs.drop).hide();
      // `$props.query` would be initialized to `{ limit: 10, offset: 0, sort: '', order: '' }` by default
      // custom query conditions must be set to observable by using `Vue.set / $vm.$set`
      this.$set(query, this.field, this.keyword)
      query.offset = 0 // reset pagination
    }
  }
}
</script>
<style lang="scss" scoped>
  .filterable {
    border-bottom: 1px dashed;
    cursor: pointer;
  }
</style>
