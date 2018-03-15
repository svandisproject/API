<template lang="html">
  <section class="new-feed">
    <h2>Edit Website post</h2>
    <ui-card>
        <form class="uk-form-stacked">
            <div class="col-md-8 large">
                <h3>
                    <label v-for="tag in allTags">
                        <input
                                :checked="postTags.indexOf(tag.id) !== -1"
                                @change="change(tag.id)"
                                type="checkbox"
                        > {{ tag.title }}
                    </label>
                </h3>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label">Title</label>
                <div class="uk-form-controls">
                    <input class="uk-input" v-model="form.title" placeholder="Post title">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">URL</label>
                <div class="uk-form-controls">
                    <input class="uk-input" v-model="form.url" placeholder="URL">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">Content</label>
                <div class="uk-form-controls">
                    <input class="uk-input" v-model="form.content" placeholder="Content">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">Source</label>
                <div class="uk-form-controls">
                    <input class="uk-input" v-model="form.source" placeholder="Source">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">Published at</label>
                <div class="uk-form-controls">
                    <input type="date" class="uk-input" v-model="form.publishedAt" placeholder="Published at">
                </div>
            </div>
            <div class="uk-margin">
                <button @click.prevent="save" primary>Save</button>
            </div>

        </form>
    </ui-card>
  </section>
</template>

<script lang="js">
  import config from '../config'
  export default  {
      name: 'website-post-form',
    data () {
        return {
            form: {
                title: '',
                url: '',
                content: '',
                source: '',
                publishedAt: '',
            },
            postTags: [],
            allTags: [],
            action: config.API_URL + '/website-post/' + this.$route.params.id
        }
    },
    mounted() {
        this.$axios.get(this.action)
            .then((response) => {
               this.form = {
                   title: response.data.title,
                   url: response.data.url,
                   content: response.data.content,
                   source: response.data.source,
                   publishedAt: response.data.publishedAt
               };
               this.postTags = response.data.tags
            });
        this.$axios.get(config.API_URL + '/tag').then((response) => {
            this.allTags = response.data;
        });
    },
    methods: {
        save() {
            this.$axios.put(this.action, {'website_post': this.form, 'tags': this.postTags})
                .then((response) => {
                    console.log(response)
                    this.$notify({
                        title: 'Yay!',
                        position: 'top center',
                        group: 'api',
                        text: 'Successfully saved feed',
                        type: 'success',
                    });
                })
        },
        change(id){
            let index = this.postTags.indexOf(id);
            if(index !== -1){
                this.postTags.splice(index, 1);
            }else {
                this.postTags.push(id)
            }
        }
    }
}
</script>

<style scoped lang="scss">
</style>
