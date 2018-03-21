<template lang="html">
  <section class="tag-new">
        <form class="uk-form-stacked">
            <div class="uk-margin">
                <label class="uk-form-label">Title</label>
                <div class="uk-form-controls">
                    <input class="uk-input" v-model="tag.title" placeholder="Tag title">
                </div>
            </div>
             <div class="uk-margin">
                <button @click.prevent="save" primary>Save</button>
             </div>
        </form>
  </section>
</template>

<script lang="js">
  import config from '../config'
  export default  {
    name: 'tag-add',
    data () {
        return {
            tag: {
                title: ''
            },
        }
    },
    methods: {
        save() {
            this.$axios.post(config.API_URL + '/tag', {tag: this.tag})
                .then((response) => {
                    this.$emit('tagAdded');
                })
        }
    }
}
</script>

<style scoped lang="scss">
</style>
