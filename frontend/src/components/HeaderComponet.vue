<script>
  import { store } from '../store.js'
  import axios from 'axios';
  import Cookies from 'js-cookie';
  export default {
    data() {
      return {
        store
      }
    },
    created() {

    },
    methods: {
      logout() {
        const token = Cookies.get('token');
        console.log(token)
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
          axios.post('http://localhost:8000/api/logout', null)
            .then(response => {
              console.log(response);
              document.cookie = 'token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
              this.$router.push('/'); 
              this.store.isAutenticathed = false;
          })
          .catch(error => {
            console.log(error);
            // Gestione degli errori
            this.$router.push('/'); 
            document.cookie = 'token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            this.store.isAutenticathed = false;
          });
}}}
</script>

<template>
    <header class="z-3" v-show="store.checkingToken == false">
        <div class="container py-4 d-flex justify-content-between align-items-center">
            <div class="title fw-bold">
                <router-link class="text-decoration-none text-light ms-1 d-flex align-items-center" to="/">
                    <div class="logo me-2">
                        <img class="img-fluid" src="../../public/logo_transparent.png" alt="">
                    </div>
                    <span class="none">MY WALLET</span></router-link>
            </div>

            <nav v-if="store.isAutenticathed == false">
                <ul class="d-flex list-unstyled m-0">
                    <li>
                        <router-link class="btn btn-light fw-bolder" to="/login">SIGN IN</router-link>
                    </li>
                    <li>
                        <router-link class="btn btn-outline-light fw-bolder ms-4" to="/register">REGISTER</router-link>
                    </li>
                </ul>
            </nav>

            <nav v-else-if="store.isAutenticathed">
                <ul class="list-unstyled d-flex m-0">
                    <li v-if="$route.path !== '/dashboard' && $route.path !== '/admin'">
                      <router-link class="btn btn-dark me-5 p-2 px-3 fw-bolder" to="/admin">Go To Your Dashboard</router-link>
                    </li>
                    <li>
                        <button @click="logout" class="btn btn-danger fw-bolder">Log Out</button>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
</template>

<style lang="scss" scoped>;
@import "../../node_modules/rfs/scss.scss";
header {
    transition: all 0.2s ease-in-out;

    &:hover {
    background-color: rgba(0, 0, 0, 0.3);
    }
    
    .title {
    @include font-size(2rem);
    }

    .logo {
        width: 80px;
        height: 75px;
    }

}


@media screen and (max-width: 767px) {
  .none {
    display: none; 
  }
}
</style>
