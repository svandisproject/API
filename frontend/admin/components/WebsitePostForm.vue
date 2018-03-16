<template lang="html">
    <section class="new-feed">
        <h2>Edit Website post</h2>
        <ui-card>
            <form class="uk-form-stacked">
                <div class="col-md-8 large">
                    <h3>
                        <label v-for="tag in allTags">
                            <input
                                    :checked="post.tags.indexOf(tag.id) !== -1"
                                    @change="change(tag.id)"
                                    type="checkbox"
                            > {{ tag.title }}
                        </label>
                    </h3>
                </div>
                <div v-if="addTag">
                    <button @click.prevent="addTag = !addTag">add tag</button>
                </div>
                <div v-else>
                    <tag-add v-on:tagAdded="tagAdded"></tag-add>
                    <button @click.prevent="addTag = !addTag">Hide form</button>
                </div>


                <div class="uk-margin">
                    <label class="uk-form-label">Title</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" v-model="post.title" placeholder="Post title">
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label">URL</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" v-model="post.url" placeholder="URL">
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label">Content</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" v-model="post.content" placeholder="Content">
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label">Source</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" v-model="post.source" placeholder="Source">
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label">Published at</label>
                    <div class="uk-form-controls">
                        <input type="date" class="uk-input" v-model="post.publishedAt" placeholder="Published at">
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
    import TagAdd from './TagAdd'
    export default  {
        name: 'website-post-form',
        components: { TagAdd },
        data () {
            return {
                post: {
                    title: '',
                    url: '',
                    content: '',
                    source: '',
                    publishedAt: '',
                    tags: [],
                },
                allTags: [],
                action: config.API_URL + '/website-post/' + this.$route.params.id,
                addTag: true,
            }
        },
        mounted() {
            this.$axios.get(this.action)
                .then((response) => {
                    this.post = {
                        title: response.data.title,
                        url: response.data.url,
                        content: response.data.content,
                        source: response.data.source,
                        publishedAt: response.data.published_at,
                        tags: []
                    };
                    for(var tag in response.data.tags){
                        this.post.tags.push(response.data.tags[tag].id)
                    }
                });
            this.$axios.get(config.API_URL + '/tag/filter?limit=100').then((response) => {
                this.allTags = response.data.rows;
            });
        },

        methods: {
            save() {
                this.$axios.put(this.action, {'website_post': this.post})
                    .then((response) => {
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
                let index = this.post.tags.indexOf(id);
                if(index !== -1){
                    this.post.tags.splice(index, 1);
                }else {
                    this.post.tags.push(id)
                }
                console.log(this.post.publishedAt)
            },
            tagAdded(){
                this.addTag = !this.addTag;
                this.$axios.get(config.API_URL + '/tag/filter?limit=100').then((response) => {
                    this.allTags = response.data.rows;
                });
            }
        }
    }
</script>

<style scoped lang="scss">
</style>
