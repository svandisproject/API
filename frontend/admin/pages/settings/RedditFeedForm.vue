<template lang="html">
  <section class="new-feed">
    <h2 v-if="isNew">Add new Reddit Feed</h2>
    <h2 v-if="!isNew">Edit Reddit Feed</h2>
    <ui-card>
        <form class="uk-form-stacked">

             <div class="uk-margin">
                <label class="uk-form-label">User agent</label>
                <div class="uk-form-controls">
                    <input class="uk-input" v-model="form.userAgent" placeholder="User agent">
                </div>
            </div>
             <div class="uk-margin">
                <label class="uk-form-label">Client ID</label>
                <div class="uk-form-controls">
                    <input class="uk-input" v-model="form.clientId" placeholder="Client ID">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">Client secret</label>
                <div class="uk-form-controls">
                    <input class="uk-input" v-model="form.clientSecret" placeholder="Client secret">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">User name</label>
                <div class="uk-form-controls">
                    <input class="uk-input" v-model="form.userName" placeholder="User name">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">User password</label>
                <div class="uk-form-controls">
                    <input class="uk-input" v-model="form.userPassword" placeholder="User password">
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
    name: 'reddit-feed-form',
    data () {
        return {
            form: {
                userAgent: '',
                clientId: '',
                clientSecret: '',
                userName: '',
                userPassword: '',
                timeInterval: ''
            },
            method: 'post',
            action: config.API_URL + '/reddit-feed',
            isNew: true
        }
    },
    mounted() {
        if(this.$route.params.id) {
            this.$axios.get(config.API_URL + '/reddit-feed/'+this.$route.params.id)
                .then((response) => {
                   this.form = {
                       userAgent: response.data.user_agent,
                       clientId: response.data.client_id,
                       clientSecret: response.data.client_secret,
                       userName: response.data.user_name,
                       userPassword: response.data.user_password,
                       timeInterval: response.data.time_interval
                   }
                });
            this.action = config.API_URL + '/reddit-feed/' + this.$route.params.id;
            this.method = 'put';
            this.isNew = false;
        }

    },
    methods: {
        save() {
            this.$axios[this.method](this.action, {'reddit_feed': this.form})
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
