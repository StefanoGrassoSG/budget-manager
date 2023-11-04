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
    this.getSingle()
  },
    methods: {
        getSingle() {
            console.log(this.store.singleId)
            this.store.minLoad = true
            axios.post(`http://localhost:8000/api/show/${localStorage.getItem('singleId')}`)
            .then(res => {
                this.store.minLoad = false
                this.store.single = res.data.data
                console.log( this.store.single, 'VEDIAMOOO')
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
            this.$router.push('/admin/transactions')
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
                <div class="card text-bg-light mb-3" style="max-width: 25%;">
                    <div class="card-header">Transazione</div>
                    <div class="card-body">
                        <h5 class="card-title">Dettagli Transazione</h5>
                        <hr>
                        <h6 class="card-text fw-bold">Descrizione:</h6>
                        <p>{{ store.single.description }}</p>
                        <hr>
                        <h6 class="card-text fw-bold">Data:</h6>
                        <p>{{ store.single.date }}</p>
                        <hr>
                        <h6 class="card-text fw-bold">Ammontare:</h6>
                        <p>{{ store.single.amount }}</p>
                        <hr>
                        <h6 class="card-text fw-bold">Categoria:</h6>
                        <p>{{ store.single.expense__categories.name }}</p>
                        <hr>
                        <h6 class="card-text fw-bold">Metodo di pagamento:</h6>
                        <p>{{ store.single.payment_method.name }}</p>
                        <hr>
                        <h6 class="card-text fw-bold">Azioni:</h6>
                        <button @click="deleteTransaction(store.single.id)" class="btn btn-danger">Elimina</button>
                        <button class="btn btn-warning ms-3">Modifica</button>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss">

</style>
