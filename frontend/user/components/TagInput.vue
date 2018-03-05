<template lang="html">
  <div class="tags-input">
    <div class="form-group">
    <div class="container">
        <div class="row">
            <div class="col-md-8 large">
                <h3>
                    <label v-for="tag in allTags" class="tag label label-lg label-default"
                    v-bind:class="{'label-success': typeof value !== 'undefined' && value.indexOf(tag.id) > -1}"
                    @contextmenu.prevent="handleRemove(tag.id)"
>
                        <input type="checkbox" :value="tag.id" v-model="tags" class="hidden"> {{ tag.title }}
                    </label>
                </h3>
            </div>
            <div class="col-md-4 well">
            <h3>Create tag</h3>
                <div class="form-group">
                    <label for="tag-title">Title</label>
                    <input id="tag-title" v-model="tag.title" class="form-control">
                </div>
                <!--<btn type="success" class="btn-block" @click="createTag">Create</btn>-->
            </div>
        </div>
    </div>
  </div>
  <!--<context-menu id="context-menu" ref="ctxMenu">-->
      <!--<li @click="removeTag()"><i class="fa fa-trash"></i> Remove</li>-->
  <!--</context-menu>-->
  </div>

</template>

<script lang="js">

  export default  {
    name: 'tag-input',
    props: ['value'],
    data() {
      return {
        tags: [],
        allTags: [],
        tag: {
            title: ''
        },
        removingTag: null
      }
    },
    mounted() {
       this.$axios.get('/api/tag').then((response) => {
           this.allTags = response.data
       })
       this.tags = this.value
    },
    watch: {
        tags(value) {
            this.$emit('input', value)
        }
    },
    methods: {
      createTag() {
        axios.post('/api/tag', {tag: this.tag})
            .then((response) => {
                this.$store.commit('addTag', response.data)
            })
      },
      removeTag() {
          axios.delete('/api/tag/'+this.removingTag)
              .then(() => {
                  this.$store.commit('removeTag', this.removingTag)
                  this.removingTag = null
              })
      },
//      handleRemove(id) {
//          this.$refs.ctxMenu.open()
//          this.removingTag = id;
//      }
    },
//    components: { contextMenu },
    computed: {

    }
}
</script>

<style scoped lang="stylus">
  .tags-input
    .tag
      margin-right 1rem;
      cursor pointer
      display inline-block
      user-select none
</style>
<style lang="stylus">
    .ctx-menu
      font-size 1.1rem
      padding 0
      li
        cursor pointer
        padding 1rem .5rem
        font-size 1.5em
      &:hover
        background #ddd

</style>
