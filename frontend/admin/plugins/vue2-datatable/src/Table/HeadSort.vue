<template>
  <a href="#" @click.prevent="handleClick" name="HeadSort">
    <ui-icon :i="icon" class="uk-icon-link" />
  </a>
</template>
<script>
/**
 * Sorting arrows within <th>
 */
export default {
  name: 'HeadSort',
  props: {
    field: { type: String, required: true },
    query: { type: Object, required: true }
  },
  data: () => ({
    order: ''
  }),
  computed: {
    icon () {
      if(this.order === 'asc') {
          return 'chevron-up'
      } else if (this.order === 'desc') {
          return 'chevron-down'
      } else {
          return 'chevron-right'
      }
    }
  },
  watch: {
    query: {
      handler ({ sort: field, order }) {
        this.order = field === this.field ? order : ''
      },
      deep: true,
      immediate: true
    }
  },
  methods: {
    handleClick () {
      const { query, order } = this
      query.sort = this.field
      query.order = this.order = order === 'desc' ? 'asc' : 'desc'
    }
  }
}
</script>
