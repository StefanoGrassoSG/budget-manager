<script >
import axios from 'axios';
import MiniLoadingComponent from './MiniLoadingComponent.vue';
import { store } from '../store.js';
export default {
  data() {
    return {
        store,
        show:false,
        transactionToDeleteId: null,
    }
  },
  components: {
    MiniLoadingComponent
  },
  created() {
    this.getAll()
  },
    methods: {
        getAll() {
            this.store.minLoad = true
            axios.get('http://localhost:8000/api/index', null)
            .then(res => {
                console.log(res.data.data)
                this.store.transactions = res.data.data
                console.log(this.store.transactions)
                this.store.minLoad = false
            })
            .catch(err => {
                console.log(err)
            })
        },
        deleteTransaction(transactionId) {
            this.show = true
            this.transactionToDeleteId = transactionId;
        },
        deleteFinal() {
        axios.post(`http://localhost:8000/api/destroy/${this.transactionToDeleteId}`)
        .then(res => {
            this.show = false
            console.log(res.data)
            const index = this.store.transactions.data.findIndex(item => item.id === this.transactionToDeleteId);
            if (index !== -1) {
                this.store.transactions.data.splice(index, 1);
            }
        })
        .catch(err => {
            console.log(err)
        })
        },
        reset() {
            this.show = false
        }
    }
}
</script>

<template>
    <MiniLoadingComponent v-if="store.minLoad" />
    <div v-else class="container-fluid h-100 overflow-auto">
        <div class="modal d-block" v-if="show">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Attenzione</h5>
                    <button type="button" @click="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Sei sicuro di voler eliminare questa transazione?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" @click="reset" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <button type="button" @click="deleteFinal" class="btn btn-primary">Conferma</button>
                </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="mb-2 d-flex">
                    <select class="form-select form-select-sm w-25" aria-label="Small select example">
                        <option selected>Seleziona mese di riferimento</option>
                        <option value="1">Novembre</option>
                        <option value="2">Ottobre</option>
                    </select>
                    <div>
                        <router-link  to="/admin/create" class="btn btn-success ms-3">Aggiungi+</router-link>
                    </div>
                </div>
                <table class="table table-striped table-white fs-4 border border-5 border-white table-striped-columns table-bordered border-primary">
                    <thead>
                        <tr>
                        <th scope="col">Data</th>
                        <th scope="col">Descrizione</th>
                        <th scope="col">Ammontare</th>
                        <th scope="col">Metodo di pagamento</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="row in store.transactions.data">
                            <td>{{ row.date }}</td>
                            <td>{{ row.description }}</td>
                            <td>{{ row.amount }}</td>
                            <td>{{ row.payment_method.name }}</td>
                            <td>{{ row.expense__categories.name }}</td>
                            <td>
                                <button class="btn btn-primary">Dettagli</button>
                                <button class="btn btn-warning mx-2">Modifica</button>
                                <button @click="deleteTransaction(row.id)" class="btn btn-danger">Elimina</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<style lang="scss">

</style>
