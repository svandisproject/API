<template lang="html">

  <section class="tags">
        <tag-input></tag-input>
  </section>

</template>

<script lang="js">
  import TagInput from '../components/TagInput'
  export default  {
      name: 'tag',
      components: {TagInput}
  }
</script>