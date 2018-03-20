<template lang="html">
  <section class="new-feed">
    <h2 v-if="isNew">Add new Twitter User</h2>
    <h2 v-if="!isNew">Edit Twitter User</h2>
    <ui-card>
        <form class="uk-form-stacked">

            <div class="uk-margin">
                <label class="uk-form-label">Mode</label>
                <div class="uk-form-controls">
                    <input class="uk-input" v-model="form.mode" placeholder="Mode">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">Consumer Key</label>
                <div class="uk-form-controls">
                    <input class="uk-input" v-model="form.consumerKey" placeholder="Consumer Key">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">Consumer Secret</label>
                <div class="uk-form-controls">
                    <input class="uk-input" v-model="form.consumerSecret" placeholder="Consumer Secret">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">Access Token Key</label>
                <div class="uk-form-controls">
                    <input class="uk-input" v-model="form.accessTokenKey" placeholder="Access Token Key">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">Access Token Secret</label>
                <div class="uk-form-controls">
                    <input class="uk-input" v-model="form.accessTokenSecret" placeholder="Access Token Secret">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">Time Interval</label>
                <div class="uk-form-controls">
                    <input class="uk-input" v-model="form.timeInterval" placeholder="Time Interval">
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
    name: 'twitter-user-form',
    data () {
        return {
            form: {
                mode: '',
                consumerKey: '',
                consumerSecret: '',
                accessTokenKey: '',
                accessTokenSecret: '',
                timeInterval: ''
            },
            method: 'post',
            action: config.API_URL + '/twitter-user',
            isNew: true
        }
    },
    mounted() {
        if(this.$route.params.id) {
            this.$axios.get(config.API_URL + '/twitter-user/'+this.$route.params.id)
                .then((response) => {
                   this.form = {
                       mode: response.data.mode,
                       consumerKey: response.data.consumer_key,
                       consumerSecret: response.data.consumer_secret,
                       accessTokenKey: response.data.access_token_key,
                       accessTokenSecret: response.data.access_token_secret,
                       timeInterval: response.data.time_interval,
                   }
                });
            this.action = config.API_URL + '/twitter-user/' + this.$route.params.id;
            this.method = 'put';
            this.isNew = false;
        }

    },
    methods: {
        save() {
            this.$axios[this.method](this.action, {'twitter_user': this.form})
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
