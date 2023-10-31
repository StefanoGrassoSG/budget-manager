<script>
import PulseLoader from 'vue-spinner/src/PulseLoader.vue'
export default {
    data() {
      return {

      }
    },
    components: {
        PulseLoader
    }}
</script>

<template>
    <div class="loading position-relative">
        <div class="position-absolute top-50 start-50 translate-middle">
            <pulse-loader :loading="loading" :color="color" :size="size"></pulse-loader>
        </div>
    </div>  
</template>

<style lang="scss" scoped>
.loading {
    width: 100%;
    height: 100vh;
    background-color: white;
    z-index: 999;
}
</style>