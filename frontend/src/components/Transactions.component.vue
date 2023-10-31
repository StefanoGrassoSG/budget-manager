<script >
import axios from 'axios';
import { store } from '../store.js';
export default {
  data() {
    return {
        store
    }
  },
  created() {
    this.getAll()
  },
    watch: {
        'this.store.TransactionsComponent': 'goToTransactions'
        },
    methods: {
        goToTransactions() {
        this.store.TransactionsComponent = true
        this.store.StatComponent = false
        },
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
        }
    }
}
</script>

<template>
    <div class="container-fluid h-100 overflow-auto">
        <div class="row">
            <div class="col-12">
                <div class="mb-2">
                    <select name="" id=""></select>
                </div>
                <table class="table table-striped table-success fs-4 border border-5 border-white table-striped-columns table-bordered border-primary">
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
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
                            <th scope="row">1</th>
                            <td>2023-10-02</td>
                            <td>Spesa alimentare</td>
                            <td>32.11</td>
                            <td>Visa</td>
                            <td>Alimentazione</td>
                            <td>
                                <button class="btn btn-primary">Dettagli</button>
                                <button class="btn btn-warning">Modifica</button>
                                <button class="btn btn-danger">Elimina</button>
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
