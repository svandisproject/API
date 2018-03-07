<template lang="html">
    <div class="tags-input">
        <div class="form-group">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 well">
                        <div class="form-group">
                            <label for="user-title">Email</label>
                            <input id="user-title" v-model="fbUser.email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="user-pass">Password</label>
                            <input id="user-pass" v-model="fbUser.password" class="form-control">
                        </div>
                        <button class="btn-block" @click="createFbUser">Create FB User</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script lang="js">

    export default {
        name: 'fbUser-input',
        data() {
            return {
                fbUsers: [],
                fbUser: {
                    email: '',
                    password: ''
                }
            }
        },
        methods: {
            createFbUser() {
                this.$axios.post('/api/facebook-user', {'facebook_user': this.fbUser})
                    .then((response) => {
                        console.log(response);
                    })
            },

        }
    }
</script>
