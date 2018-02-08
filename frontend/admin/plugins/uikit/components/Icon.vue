<template lang="html">
    <span :uk-icon="i"></span>
</template>
<script lang="js">
  export default  {
    name: 'ui-icon',
    props: {'i':{type: String, default: '', required: true}}
}
</script>