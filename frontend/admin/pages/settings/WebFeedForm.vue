<template lang="html">
  <section class="new-feed">
    <h2 v-if="isNew">Add new Web feed</h2>
    <h2 v-if="!isNew">Edit Web feed</h2>
    <ui-card>
        <form class="uk-form-stacked">

            <div class="uk-margin">
                <label class="uk-form-label">Title</label>
                <div class="uk-form-controls">
                    <input class="uk-input" v-model="form.title" placeholder="Feed title">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">URL</label>
                <div class="uk-form-controls">
                    <input class="uk-input" v-model="form.url" placeholder="URL">
                </div>
             </div>
            <div class="uk-margin">
                <label class="uk-form-label">Title selector</label>
                <div class="uk-form-controls">
                    <input class="uk-input" v-model="form.titleSelector" placeholder="Title selector">
                </div>
             </div>
             <div class="uk-margin">
                <label class="uk-form-label">Content selector</label>
                <div class="uk-form-controls">
                    <input class="uk-input" v-model="form.contentSelector" placeholder="Content selector">
                </div>
             </div>
             <div class="uk-margin">
                <label class="uk-form-label">Published at selector</label>
                <div class="uk-form-controls">
                    <input class="uk-input" v-model="form.publishedAtSelector" placeholder="Published at selector">
                </div>
             </div>
             <div class="uk-margin">
                <label class="uk-form-label">Date format</label>
                <div class="uk-form-controls">
                    <input class="uk-input" v-model="form.dateFormat" placeholder="Date format">
                </div>
             </div>
            <div class="uk-margin">
                <label class="uk-form-label">Interval</label>
                <div class="uk-form-controls">
                    <input class="uk-input" v-model="form.timeInterval" placeholder="Interval">
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
  import config from '../../config'
  export default  {
    name: 'web-feeds-form',
    data () {
        return {
            form: {
                title: '',
                url: '',
                titleSelector: '',
                contentSelector: '',
                publishedAtSelector: '',
                dateFormat: '',
                timeInterval: ''
            },
            method: 'post',
            action: config.API_URL + '/web-feed',
            isNew: true
        }
    },
    mounted() {
        if(this.$route.params.id) {
            this.$axios.get(config.API_URL + '/web-feed/'+this.$route.params.id)
                .then((response) => {
                   this.form = {
                       title: response.data.title,
                       url: response.data.url,
                       titleSelector: response.data.title_selector,
                       contentSelector: response.data.content_selector,
                       publishedAtSelector: response.data.published_at_selector,
                       dateFormat: response.data.date_format,
                       timeInterval: response.data.time_interval
                   }
                })
            this.action = config.API_URL + '/web-feed/' + this.$route.params.id;
            this.method = 'put';
            this.isNew = false;
        }

    },
    methods: {
        save() {
            this.$axios[this.method](this.action, {web_feed: this.form})
                .then((response) => {
                    this.$notify({
                        title: 'Yay!',
                        position: 'top center',
                        group: 'api',
                        text: 'Successfully saved feed',
                        type: 'success',
                    });
                })
        }
    }
}
</script>

<style scoped lang="scss">
</style>
