<template lang="html">
<span>
    <router-link to="/"><ui-icon i="pencil" class="uk-icon-button"></ui-icon></router-link>
    <router-link to="/"><ui-icon i="trash" class="uk-icon-button danger"></ui-icon></router-link>
</span>
</template>

<script lang="js">
  export default  {
    name: 'table-actions',
    props: ['row'],
      mounted() {
        console.log(this.row)
      }
  }
</script>
