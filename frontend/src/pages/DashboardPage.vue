<script>
import axios from 'axios';
import Cookies from 'js-cookie';
import LoadingComponent from '../components/LoadingComponent.vue';
import { store } from '../store.js';
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
      LoadingComponent,
      StatComponent
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
            this.$router.push('/login'); 
            this.store.checkingToken = false
          })
      }
  }};
</script>

<template>
      <LoadingComponent v-if="store.checkingToken" />
      <main v-else>
            <div class="main-section d-flex">
              <aside class="my-vh bg-white">
                    <div class="aside-links mx-0 mx-sm-3 my-5">
                        <h3 class="menu-title d-none d-sm-block">
                            MENU
                        </h3>
                        <ul>
                            <li>
                                <router-link to="/admin">
                                  <p class="messages-asidetext">
                                       Statistiche
                                  </p>
                                </router-link>
                            </li>
                            <li>
                              <router-link to="/admin">
                                  <p class="messages-asidetext">
                                       Le Tue Transazioni
                                  </p>
                                </router-link>                         
                            </li>
                             <li> 
                              <router-link to="/admin">
                                  <p class="messages-asidetext">
                                       Note Personali
                                  </p>
                                </router-link>
                            </li> 
                        </ul>
                    </div>
              </aside>

              <div class="content" v-if="store.stat">
                <StatComponent />
              </div>
            </div>
        </main>
</template>

<style lang="scss" scoped>;
@import "../../node_modules/rfs/scss.scss";
h1 {
    @include font-size(2rem);
}

.content {
  padding: 20px;
}

main {
  background-color: #F1F4F4;
}

aside {
    background-color: black;
    width: 20vw;
    height: 100vh;
    position: relative;
    padding: 30px;
    border-right: 1px solid black;

    .logo-aside {
        border-bottom: 4px solid #b8dff8;

        img {
            width: 50px;
        }
    }

    .aside-links {
        padding-left: 10px;

        .menu-title {
            color: black;
            font-weight: 900;
        }

        ul {
            padding: 0;

            li {
                list-style: none;
                margin: 40px 0;

                a {
                    font-size: 20px;
                    font-weight: bold;
                    color: #888A8C;
                    text-decoration: none;
                }

                a:hover {
                    color: #636567;
                }
            }
        }
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
