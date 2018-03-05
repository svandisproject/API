<template lang="html">
    <a class="logout" @click="logout">
        <slot>
            <ui-icon i="lock"/> Logout
        </slot>
    </a>
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