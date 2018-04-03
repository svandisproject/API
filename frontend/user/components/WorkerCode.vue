<template lang="html">
    <section>
        <h2>Workers <ui-button @click.native="$router.push({name: 'worker_new'})" primary>New</ui-button></h2>
        <ui-card>
            To register new worker run <pre>$ ./worker register --secret {{secret}}</pre>
        </ui-card>
    </section>
</template>

<script lang="js">
  export default  {
    name: 'worker-code',
    mounted() {
        this.$axios.get('/api/settings/worker/secret')
            .then((response) => {
                this.secret = response.data.secret
            })
            .catch((error) => {
                console.error('Failed loading worker code')
            })
    },
    data() {
      return {
         secret: ''
      }
    }
}
</script>