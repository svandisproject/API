<template lang="html">
  <form class="login">
    <div class="uk-margin">
        <div class="uk-inline">
            <ui-icon i="mail" class="uk-form-icon"  />
            <input type="email"
                   name="email"
                   v-validate="'required|email'"
                   v-model="email"
                   class="uk-input uk-form-width-large"
                   placeholder="Email"
                   :class="{'uk-form-danger': errors.has('email')}"
                   >
        </div>
    </div>
    <div class="uk-margin">
        <div class="uk-inline">
            <ui-icon i="lock" class="uk-form-icon" />
            <input type="password"
                   name="password"
                   v-validate="'required'"
                   v-model="password"
                   class="uk-input uk-form-width-large"
                   placeholder="Password"
                   :class="{'uk-form-danger': errors.has('password')}"
                   >
        </div>
    </div>
    <button class="uk-button uk-button-primary" @click.prevent="login">Login</button>
  </form>

</template>

<script lang="js">
  import jwtDecode from 'jwt-decode';
  import config from '../../config';

  export default  {
    name: 'k-login',
    data() {
      return {
        email: null,
        password: null,
      }
    },
    methods: {
        login() {
            if(this.$validator.errors.count() > 0) {
                return;
            }
            this.$axios.post('/api/login_check', {username: this.email, password: this.password})
                .then((response) => {
                    let user = jwtDecode(response.data.token);
                    this.$store.commit('SET_JWT_TOKEN', response.data.token)
                    this.$store.commit('SET_USER', jwtDecode(response.data.token))
                    this.$router.push('/')
                    this.$axios.defaults.headers.common['Authorization'] = 'Bearer ' + response.data.token
                })
                .catch((error) => {
                    this.$notify({
                        title: 'Authentication error',
                        position: 'top center',
                        group: 'auth',
                        text: error.response.data.message,
                        type: 'error',
                    });
                })

        }
    }
}
</script>
