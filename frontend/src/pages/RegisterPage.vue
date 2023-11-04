<script>
import { store } from '../store.js'
import Cookies from 'js-cookie';
import axios from 'axios';
   export default {
    data() {
      return {
        formData: {
            name: '',
            lastName: '',
            email: '',
            password: '',
        },
        store
      }
    },
    methods: {
        sendData() {
            axios.post('http://127.0.0.1:8000/api/register', this.formData)
            .then(response => {
              console.log(response.data)
              if(response.data.user) {
                this.store.isAutenticathed = true;
                const token = response.data.authorisation.token;
                console.log(token)
                Cookies.set('token', token, { expires: 7 });
                this.$router.push('/admin');
              }
            }).catch (err => {{
              if (err.response && err.response.data && err.response.data.errors) {
                  this.store.registerErrors = err.response.data.errors;
                  console.log(err);
                } else {
                 
                }
              }
            }
            )
        }
    }
  };
</script>

<template>
       <div class="container-fluid d-flex">
          <div class="aside position-relative">
            <div class="position-absolute top-50 start-50 translate-middle text-center p-2">
              <hr class="text-dark">
              <p class="fw-bold fs-2 text-dark">
                "Log in to track your income and expenses, plan your budget, and efficiently work toward your financial goals. Your financial control begins here."
              </p>
              <hr class="text-dark">
            </div>
          </div>
          <div class="form-container p-5 shadow mt-5  container-sm bg-transparent d-flex flex-column align-items-center justify-content-center">
              <form class="w-100" @submit.prevent="sendData">
                  <div class="form-floating mb-3 w-100">
                      <input v-model="formData.name" type="text" name="name" class="form-control" id="name" placeholder="First name">
                      <label for="floatingInput">First name</label>
                      <div class="mt-1 text-danger" v-if="store.registerErrors.name">
                          {{ store.registerErrors.name[0] }}
                      </div>
                  </div>
                  <div class="form-floating mb-3 w-100">
                      <input v-model="formData.lastName" type="text" name="lastName" class="form-control" id="lastName" placeholder="Last name">
                      <label for="floatingInput">Last name</label>
                      <div class="mt-1 text-danger" v-if="store.registerErrors.lastName">
                          {{ store.registerErrors.lastName[0] }}
                      </div>
                  </div>
                  <div class="form-floating mb-3 w-100">
                      <input v-model="formData.email" type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                      <label for="floatingInput">Email address</label>
                      <div class="mt-1 text-danger" v-if="store.registerErrors.email">
                          {{ store.registerErrors.email[0] }}
                      </div>
                  </div>
                  <div class="form-floating w-100">
                      <input v-model="formData.password" type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                      <label for="floatingPassword">Password</label>
                      <div class="mt-1 text-danger" v-if="store.registerErrors.password">
                          {{ store.registerErrors.password[0] }}
                      </div>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 fw-bold py-3 mt-4">
                      Create Account
                  </button>
                  <p class="text-black text-center mt-5">
                      Already have an account?  
                      <router-link class="text-decoration-none text-dark" to="/login">SIGN IN</router-link>
                  </p>
              </form>
          </div> 
       </div>
</template>

<style lang="scss" scoped>;
.aside {
  width: 40%;
  height: 80vh;
}
.form-container {
  width: 60%;
}

@media screen and (min-width: 400px) {
  /* Selettore dell'elemento a cui vuoi impostare la larghezza */
  .form-container {
    width: 80%; /* Imposta la larghezza al 25% quando la media query è attiva */
  }
}


@media screen and (min-width: 543px) {
  /* Selettore dell'elemento a cui vuoi impostare la larghezza */
  .form-container {
    width: 80%; /* Imposta la larghezza al 25% quando la media query è attiva */
  }
}


@media screen and (min-width: 600px) {
  /* Selettore dell'elemento a cui vuoi impostare la larghezza */
  .form-container {
    width: 50%; /* Imposta la larghezza al 25% quando la media query è attiva */
  }
}

@media screen and (min-width: 768px) {
  /* Selettore dell'elemento a cui vuoi impostare la larghezza */
  .form-container {
    width: 50%; /* Imposta la larghezza al 25% quando la media query è attiva */
  }
}

@media screen and (min-width: 884px) {
  /* Selettore dell'elemento a cui vuoi impostare la larghezza */
  .form-container {
    width: 40%; /* Imposta la larghezza al 25% quando la media query è attiva */
  }
}

@media screen and (min-width: 921px) {
  /* Selettore dell'elemento a cui vuoi impostare la larghezza */
  .form-container {
    width: 45%; /* Imposta la larghezza al 25% quando la media query è attiva */
  }
}

@media screen and (min-width: 1214px) {
  /* Selettore dell'elemento a cui vuoi impostare la larghezza */
  .form-container {
    width: 35%; /* Imposta la larghezza al 25% quando la media query è attiva */
  }
}


@media screen and (min-width: 1350px) {
  /* Selettore dell'elemento a cui vuoi impostare la larghezza */
  .form-container {
    width: 30%; /* Imposta la larghezza al 25% quando la media query è attiva */
  }
}
</style>
