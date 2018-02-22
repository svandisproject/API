<template lang="html">
    <ui-card>
        To register new worker run <pre>$ ./worker register --secret {{secret}}</pre>
    </ui-card>
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