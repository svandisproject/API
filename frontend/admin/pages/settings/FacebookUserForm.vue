<template lang="html">
  <section class="new-feed">
    <h2 v-if="isNew">Add new Facebook User</h2>
    <h2 v-if="!isNew">Edit Facebook User</h2>
    <ui-card>
        <form class="uk-form-stacked">

            <div class="uk-margin">
                <label class="uk-form-label">Email</label>
                <div class="uk-form-controls">
                    <input class="uk-input" v-model="form.email" placeholder="Email">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">Password</label>
                <div class="uk-form-controls">
                    <input class="uk-input" v-model="form.password" placeholder="Password">
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
    name: 'facebook-user-form',
    data () {
        return {
            form: {
                email: '',
                password: '',
                timeInterval: ''
            },
            method: 'post',
            action: config.API_URL + '/facebook-user',
            isNew: true
        }
    },
    mounted() {
        if(this.$route.params.id) {
            this.$axios.get(config.API_URL + '/facebook-user/'+this.$route.params.id)
                .then((response) => {
                   this.form = {
                       email: response.data.email,
                       password: response.data.password,
                       timeInterval: response.data.time_interval,
                   }
                });
            this.action = config.API_URL + '/facebook-user/' + this.$route.params.id;
            this.method = 'put';
            this.isNew = false;
        }

    },
    methods: {
        save() {
            this.$axios[this.method](this.action, {'facebook_user': this.form})
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
