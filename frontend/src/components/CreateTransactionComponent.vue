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
      this.store.errorsCreate = {}
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
                if(res.data.success) {
                  this.$router.push('/admin/transactions');
                }
            })
            .catch(err => {
                console.log(err.response.data)
                this.store.errorsCreate = err.response.data.errors
                console.log(this.store.errorsCreate)
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
                        <label for="inputEmail4" class="form-label">Data<span class="text-danger">*</span></label>
                        <input type="date" v-model="data.date" class="form-control" id="inputEmail4">
                        <div class="alert alert-danger mt-2" role="alert" v-if="store.errorsCreate.date">
                          {{ store.errorsCreate.date[0] }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Descrizione</label>
                        <input type="text" v-model="data.description" class="form-control" placeholder="Scrivi una breve descrizione..." id="inputPassword4">
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">Metodo di pagamento<span class="text-danger">*</span></label>
                        <select v-model="data.payment" id="inputState" class="form-select">
                            <option value="" selected disabled hidden>Scegli...</option>
                            <option value="1">Discover Card</option>
                            <option value="2">MasterCard</option>
                            <option value="3">Contanti</option>
                            <option value="4">Bancomat</option>
                            <option value="5">Visa</option>
                        </select>
                        <div class="alert alert-danger mt-2" role="alert" v-if="store.errorsCreate.payment">
                          {{ store.errorsCreate.payment[0] }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="inputCat" class="form-label">Categoria<span class="text-danger">*</span></label>
                        <select v-model="data.category" id="inputCat" class="form-select">
                            <option value="" selected disabled hidden>Scegli...</option>
                            <option value="1">Alloggio</option>
                            <option value="2">Alimentazione</option>
                            <option value="3">Trasporti</option>
                            <option value="4">Salute</option>
                            <option value="5">Formazione</option>
                            <option value="6">Divertimento</option>
                            <option value="7">Abbigliamento</option>
                            <option value="8">Tecnologia</option>
                            <option value="9">Risparmio</option>
                            <option value="10">Altro</option>
                        </select>
                        <div class="alert alert-danger mt-2" role="alert" v-if="store.errorsCreate.category">
                          {{ store.errorsCreate.category[0] }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="inputZip" class="form-label">Prezzo<span class="text-danger">*</span></label>
                        <input type="number" step="0.01" min="0.01" placeholder="0.00" v-model="data.price" class="form-control" id="inputZip">
                        <div class="alert alert-danger mt-2" role="alert" v-if="store.errorsCreate.price">
                          {{ store.errorsCreate.price[0] }}
                        </div>
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
