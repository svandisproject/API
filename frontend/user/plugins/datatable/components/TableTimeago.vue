<template lang="html">
    <timeago :since="value"/>
</template>

<script lang="js">
  export default  {
    name: 'table-timeago',
    props: ['value']
  }
</script>
