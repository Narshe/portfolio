<template>
    <div class="experience-img slide" :style="backgroundImage"></div>
</template>

<script>
    export default {

        props: { slide: {type:Object}},
        data() {
          return {
              id: this.slide.id,
              path: this.slide.path,
              alt: this.slide.alt
          }
        },
        computed: {

          backgroundImage() {
             return { 'background-image': `url(/storage/${this.path} )`}
          }
        }

    }
</script>

<style lang="css">
</style>
