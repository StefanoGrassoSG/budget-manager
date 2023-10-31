<script>
  import { store } from '../src/store'
  import HeaderComponent from './components/HeaderComponet.vue';
  import axios from 'axios';
  import MainComponent from './components/MainComponent.vue';

  export default {
    data() {
      return {
        store
      }
    },
    components: {
      HeaderComponent,
      MainComponent
    },
    created() {
  }
  };
</script>

<template>  
  <HeaderComponent />

  <MainComponent />

 

</template>

<style lang="scss">;

</style>
