<script>
import { store } from '../store.js'
import Cookies from 'js-cookie';
import axios from 'axios';

   export default {
    data() {
      return {
          email : '',
          password: '',
          store,
          notValid: false
      }
    },
    created() {
        if(store.isAutenticathed) {
          this.$router.push('/admin')
        }
      },
    methods: {
        tryLog() {
          axios.post('http://localhost:8000/api/login', {
              email: this.email,
              password: this.password
          })
          .then(response => {
              console.log(response.data)
              if(response.data.user) {
                this.store.isAutenticathed = true;
                this.$router.push('/admin');
                const token = response.data.access_token;
                Cookies.set('token', token, { expires: 7 });

              }
            }).catch (err => {{
              console.log(err)
              if(err.response.data.error == "invalid password") {
                this.notValid = true
                this.store.loginErrors = err.response.data.error
                console.log( this.store.loginErrors)
              }
              if (err.response && err.response.data && err.response.data.errors) {
                  this.store.loginErrors = err.response.data.errors;
                  console.log(this.store.loginErrors);
                }
              }
            }
            )
        }
    }
  };
</script>

<template>
    <div class="width p-5 shadow mt-5 container-sm bg-transparent border border-2 border-white rounded d-flex flex-column align-items-center justify-content-center">
        <form class="w-100" @submit.prevent="tryLog">
            <div class="form-floating mb-3 w-100">
                <input type="email" v-model="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
                <div class="mt-1 text-danger" v-if="store.loginErrors.email">
                          {{ store.loginErrors.email[0] }}
                </div>
            </div>
            <div class="form-floating w-100">
                <input type="password" v-model="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
                <div class="mt-1 text-danger" v-if="store.loginErrors.password">
                          {{ store.loginErrors.password[0] }}
                </div>
                <div class="mt-1 text-danger" v-if="notValid">
                          {{ store.loginErrors }}
                </div>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <div>
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label text-white ms-2" for="exampleCheck1">Remember <br> Me</label>
                </div>
                <div class="text-end">
                    <router-link class="password text-decoration-none text-white fw-bold" to="/forgot">Forgot Password?</router-link>
                </div>
            </div>
            <button type="submit"  class="btn btn-primary w-100 fw-bold py-3 mt-4">
                SIGN IN
            </button>
            <p class="text-white text-center w-100 mt-5">
                New User?
                <router-link class="text-decoration-none text-white ms-1" to="/register">SIGN UP</router-link>
            </p>
        </form>
    </div> 
</template>

<style lang="scss" scoped>
.password {
    transition: all 0.2s ease-in-out;

    &.password:hover {
    color: white!important;;
}
}

@media screen and (min-width: 400px) {
  /* Selettore dell'elemento a cui vuoi impostare la larghezza */
  .width {
    width: 80%; /* Imposta la larghezza al 25% quando la media query è attiva */
  }
}


@media screen and (min-width: 543px) {
  /* Selettore dell'elemento a cui vuoi impostare la larghezza */
  .width {
    width: 80%; /* Imposta la larghezza al 25% quando la media query è attiva */
  }
}


@media screen and (min-width: 600px) {
  /* Selettore dell'elemento a cui vuoi impostare la larghezza */
  .width {
    width: 50%; /* Imposta la larghezza al 25% quando la media query è attiva */
  }
}

@media screen and (min-width: 768px) {
  /* Selettore dell'elemento a cui vuoi impostare la larghezza */
  .width {
    width: 50%; /* Imposta la larghezza al 25% quando la media query è attiva */
  }
}

@media screen and (min-width: 884px) {
  /* Selettore dell'elemento a cui vuoi impostare la larghezza */
  .width {
    width: 40%; /* Imposta la larghezza al 25% quando la media query è attiva */
  }
}

@media screen and (min-width: 921px) {
  /* Selettore dell'elemento a cui vuoi impostare la larghezza */
  .width {
    width: 45%; /* Imposta la larghezza al 25% quando la media query è attiva */
  }
}

@media screen and (min-width: 1214px) {
  /* Selettore dell'elemento a cui vuoi impostare la larghezza */
  .width {
    width: 35%; /* Imposta la larghezza al 25% quando la media query è attiva */
  }
}


@media screen and (min-width: 1350px) {
  /* Selettore dell'elemento a cui vuoi impostare la larghezza */
  .width {
    width: 30%; /* Imposta la larghezza al 25% quando la media query è attiva */
  }
}
</style>
