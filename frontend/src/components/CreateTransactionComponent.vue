<script>
import axios from 'axios';
import Cookies from 'js-cookie';
import LoadingComponent from '../components/LoadingComponent.vue';
import { store } from '../store.js';
import StatComponent from '../components/StatComponent.vue';
import TransactionsComponent from '../components/Transactions.component.vue';
import MiniLoadingComponent from '../components/MiniLoadingComponent.vue';
import MiniFooterComponent from '../components/MiniFooterComponent.vue';

   export default {
    data() {
      return {
        store,
        data: {
            date: '',
            description: '',
            payment: '',
            category: '',
            price: null
        }
      }
    },
    created() {

    },
    methods: {
        sendData() {
            const token = Cookies.get('token');
            console.log(this.data, 'ECCO I DATI')
            axios.post('http://localhost:8000/api/store', this.data, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Authorization': `Bearer ${token}`
                }
            })
            .then(res => {
                console.log(res)
            })
            .catch(err => {
                console.log(err)
            })
        }
    },
    components: {
      LoadingComponent,
      StatComponent,
      TransactionsComponent,
      MiniFooterComponent,
      MiniLoadingComponent
    }};
</script>

<template>
      <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Data</label>
                        <input type="date" v-model="data.date" class="form-control" id="inputEmail4">
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Descrizione</label>
                        <input type="text" v-model="data.description" class="form-control" placeholder="Scrivi una breve descrizione..." id="inputPassword4">
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">Metodo di pagamento</label>
                        <select v-model="data.payment" id="inputState" class="form-select">
                            <option value="" selected disabled hidden>Scegli...</option>
                            <option value="Discover Card">Discover Card</option>
                            <option value="MasterCard">MasterCard</option>
                            <option value="Contanti">Contanti</option>
                            <option value="Bancomat">Bancomat</option>
                            <option value="Visa">Visa</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="inputCat" class="form-label">Categoria</label>
                        <select v-model="data.category" id="inputCat" class="form-select">
                            <option value="" selected disabled hidden>Scegli...</option>
                            <option value="Alloggio">Alloggio</option>
                            <option value="Alimentazione">Alimentazione</option>
                            <option value="Trasporti">Trasporti</option>
                            <option value="Salute">Salute</option>
                            <option value="Formazione">Formazione</option>
                            <option value="Divertimento">Divertimento</option>
                            <option value="Abbigliamento">Abbigliamento</option>
                            <option value="Tecnologia">Tecnologia</option>
                            <option value="Risparmio">Risparmio</option>
                            <option value="Altro">Altro</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">Prezzo</label>
                        <input type="number" placeholder="0.00" v-model="data.price" class="form-control" id="inputZip">
                    </div>
                    <div class="col-12">
                        <button type="button" @click="sendData" class="btn btn-primary">Crea</button>
                    </div>
                </div>
            </div>
        </div>
      </div>
</template>

<style lang="scss" scoped>;
@import "../../node_modules/rfs/scss.scss";
h1 {
    @include font-size(2rem);
}

.content {
  padding: 20px;
  min-height: calc(100vh - 168px);
  width: 100%;
}

main {
  background-color: #F1F4F4;
}

aside {
    background-color: black;
    position: relative;
    padding: 30px;
    border-right: 1px solid lightgray;
    border-bottom: 1px solid lightgray;
   
    border-radius: 10px;

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
                    color: black;
                    text-decoration: none;
                }

                .hover {
                  transition: all 0.2s ease-in-out;
                }

                .hover:hover {
                    color: #99C691;
                    cursor: pointer;
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
