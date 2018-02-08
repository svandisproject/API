<template lang="html">
    <div class="logout">
        <span class="logout" @click="logout"><ui-icon i="lock"/> Logout</span>
    </div>
</template>

<script lang="js">
   export default  {
        name: 'k-logout',
        methods: {
            logout() {
                this.$store.commit('LOGOUT')
                this.$router.push('/login')
            }
        }
    }
</script>