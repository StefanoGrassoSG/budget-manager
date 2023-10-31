<script>
import RingLoader from 'vue-spinner/src/RingLoader.vue'
export default {
    data() {
      return {

      }
    },
    components: {
        RingLoader
    }}
</script>

<template>
    <div class="loading position-relative">
        <div class="position-absolute top-50 start-50 translate-middle">
            <ring-loader :loading="loading" :color="color" :size="size"></ring-loader>
        </div>
    </div>  
</template>

<style lang="scss" scoped>
.loading {
    width: 100%;
    height: 100%;
    background-color: white;
    z-index: 999;
    padding: 10%;
}
</style>