<template lang="html">
  <section class="tag-new">
    <h2 v-if="isNew">Add new Tag</h2>
    <h2 v-if="!isNew">Edit Tag</h2>
    <ui-card>
        <form class="uk-form-stacked">

            <div class="uk-margin">
                <label class="uk-form-label">Title</label>
                <div class="uk-form-controls">
                    <input class="uk-input" v-model="form.title" placeholder="Tag title">
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
    name: 'tag-new',
    data () {
        return {
            form: {
                title: ''
            },
            method: 'post',
            action: config.API_URL + '/tag',
            isNew: true
        }
    },
    mounted() {
        if(this.$route.params.id) {
            this.$axios.get(config.API_URL + '/tag/'+this.$route.params.id)
                .then((response) => {
                   this.form = {
                       title: response.data.title
                   }
                });
            this.action = config.API_URL + '/tag/' + this.$route.params.id;
            this.method = 'put';
            this.isNew = false;
        }

    },
    methods: {
        save() {
            this.$axios[this.method](this.action, {tag: this.form})
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
