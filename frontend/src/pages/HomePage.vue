<script>
import axios from 'axios';
import Cookies from 'js-cookie';
import LoadingComponent from '../components/LoadingComponent.vue'
import { store } from '../store.js'
import StatComponent from '../components/StatComponent.vue';
   export default {
    data() {
      return {
        store
      }
    },
    created() {
      this.checkToken()
    },
    components: {
        LoadingComponent
    },
    methods: {
      checkToken() {
        this.store.checkingToken = true
        const token = Cookies.get('token');
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        axios.post('http://localhost:8000/api/check', null)
          .then(response => {
            console.log(response);
            if(response.status === 200) {
              this.store.isAutenticathed = true
            }
            this.store.checkingToken = false
          })
          .catch(err => {
            console.log(err)
            this.store.checkingToken = false
          })
      }
  }};
</script>

<template>
    <LoadingComponent v-if="store.checkingToken" />
    <div class="container text-light z-3 position-absolute top-50 start-50 translate-middle">
        <h1 class="text-center">
            BUDGET MANAGER
        </h1>
        <p class="text-center fs-1">
            Control your expense and income!
        </p>
    </div>

    <div class="video-background z-n1">
        <video autoplay muted loop poster="poster.jpg">
            <source src="../../public/walletbackground.mp4" type="video/mp4">
            Il tuo browser non supporta il tag video.
        </video>
    </div>

    <div class="bg-dark z-2 position-absolute bottom-0 w-100 p-5">
        <div class="container d-flex align-items-center flex-column text-center flex-md-row justify-content-around text-light">
            <div>
                <h3>
                    FAST
                </h3>
            </div>
            <div class="mymargin">
                <h3>
                    SECURE
                </h3>
            </div>
            <div>
                <h3>
                    SIMPLE
                </h3>
            </div>
        </div>
       
    </div>
</template>

<style lang="scss" scoped>;
@import "../../node_modules/rfs/scss.scss";
h1 {
    @include font-size(4rem);
}
h3 {
    @include font-size(2rem);
}

.video-background {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

video {
    width: 100%; /* Larghezza del video al 100% del contenitore */
    height: 100%; /* Altezza automatica per mantenere l'aspetto originale */
    object-fit: cover;
}


@media screen and (min-width: 400px) {
  /* Selettore dell'elemento a cui vuoi impostare la larghezza */
  .mymargin {
    margin-top: 20px;
    margin-bottom: 20px;
  }
}
</style>
