<script>
import axios from 'axios';
import Cookies from 'js-cookie';
import LoadingComponent from '../components/LoadingComponent.vue'
import { store } from '../store.js';
import ChartComponent from './ChartComponent.vue';
import MiniLoadingComponent from './MiniLoadingComponent.vue';
import LineComponent from './LineComponent.vue';
 
export default {
    data() {
      return {
        store
      }
    },
    components: {
        ChartComponent,
        LineComponent,
        MiniLoadingComponent
    },
    created() {
        this.resetData();
        this.getStats();
    },
    watch: {
    '$route': 'resetData'
    },
    methods: {
        getStats() {
        this.store.minLoad = true
        axios.get('http://localhost:8000/api/stats', null)
          .then(response => {
            console.log(response.data, 'TEST')
           this.store.stats = response.data.data.datas
           this.store.first = response.data.data.expense
           this.store.categories = response.data.data.categories
           this.store.total = response.data.data.total
           this.store.remaining = response.data.data.remaining
           this.store.expenseCalc = response.data.data.calcs
           this.store.months = response.data.data.months
           this.store.totalForMonth = response.data.data.expensePerMonth
           this.convertDate()
           console.log(this.store.months)
           console.log(this.store.stats)
           console.log(this.store.first)
           console.log(this.store.categories)
           console.log(this.store.total)
           this.store.minLoad = false
          })
          .catch(err => {
            this.store.minLoad = false
            console.log(err)
          })
      },
      resetData() {
            this.store.stats = null;
            this.store.first = '';
            this.store.categories = [];
            this.store.total = null;
            this.store.remaining = null;
            this.store.expenseCalc = [];
            this.store.months = [];
            this.store.totalForMonth = [];
        },
      convertDate() {
        this.store.months.forEach(function(month) {
        if (month.month_year.includes('10')) {
            month.month_year = "Ottobre";
        }
        });
      }

  }};
</script>

<template>
    <div class="container-fluid">
        <div class="row gx-3 gy-3">
                <div>
                    <select name="" id=""></select>
                </div>
                <div class="col-3">
                    <div class="card-stats border rounded-4">
                        <a href="{{ route('admin.message.index') }}">
                            <div class="count-text-one">
                                Hai
                            </div>
                            <div class="count-number-card" v-if="store.stats">
                                {{ store.stats.monthly_income }} euro
                            </div>
                            <div class="count-number-card" v-else-if="!store.stats && store.minLoad == false">
                                0 euro
                            </div>
                            <div class="count-number-card" v-if="store.minLoad">
                                <MiniLoadingComponent />
                            </div>
                            <div class="count-text-two">
                                Di budget mensile
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card-stats border rounded-4">
                        <div class="count-text-one">
                            Hai
                        </div>
                        <div class="count-number-card" v-if="store.total">
                                {{ store.total }} euro
                        </div>
                        <div class="count-number-card" v-else-if="!store.total && store.minLoad == false">
                            0 euro
                        </div>
                        <div class="count-number-card" v-if="store.minLoad">
                                <MiniLoadingComponent />
                        </div>
                        <div class="count-text-two">
                            Di spese mensili
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card-stats border rounded-4">
                        <div class="count-text-one">
                            Hai
                        </div>
                        <div class="count-number-card" v-if="store.remaining">
                                {{ store.remaining }} euro
                        </div>
                        <div class="count-number-card" v-else-if="!store.remaining && store.minLoad == false">
                            0 euro
                        </div>
                        <div class="count-number-card" v-if="store.minLoad">
                                <MiniLoadingComponent />
                        </div>
                        <div class="count-text-two">
                            Di Budget Disp.
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card-stats border rounded-4">
                        <a href="{{ route('admin.message.index') }}">
                            <div class="count-text-one">
                                La spesa più grossa
                            </div>
                            <div class="count-number-card" v-if="store.first.amount">
                                {{ store.first.amount }} euro
                            </div>
                            <div class="count-number-card" v-else-if="!store.first.amount && store.minLoad == false">
                                0 spese
                            </div>
                            <div class="count-number-card" v-if="store.minLoad">
                                    <MiniLoadingComponent />
                            </div>
                            <div class="count-text-two">
                                Vestito
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card-stats border rounded-4">
                        <a href="{{ route('admin.message.index') }}">
                            <div class="count-text-one">
                                Grafico categorie transazioni
                            </div>
                            <div class="count-number-card h-100">
                                <div class="chart-container" v-if="store.categories.length > 0">
                                    <ChartComponent />
                                </div>
                                <div class="count-number-card" v-else-if="store.categories.length == 0 && store.minLoad == false">
                                     Non hai spese
                                </div>
                                <div class="chart-container" v-if="store.minLoad">
                                    <MiniLoadingComponent />
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card-stats border rounded-4">
                        <a href="{{ route('admin.message.index') }}">
                            <div class="count-text-one">
                                Grafico andamento transazioni
                            </div>
                            <div class="count-number-card h-100">
                                <div class="chart-container" v-if="store.months.length > 0">
                                    <LineComponent />
                                </div>
                                <div class="count-number-card" v-else-if="store.months.length == 0 && store.minLoad == false">
                                     Non hai spese
                                </div>
                                <div class="chart-container" v-if="store.minLoad">
                                    <MiniLoadingComponent />
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
     </div>
</template>

<style lang="scss" scoped>

.title-main {
    color: black;
}

canvas {
    height: 320px;
}
.card-stats {
    padding: 20px;
    transition: all 0.3s ease-in-out;
    background-color: white;
    padding-bottom: 30px;

    .count-number-card {
        text-align: center;
        font-size: 3rem;
        color: #404357;
        font-weight: bold;

        .chart-container {
            width: 100%;
            height: 100%;
        }
    }

    .count-text-one {
        color: black;
        font-weight: bold;
        margin-bottom: 16px;
        font-size: 1.7rem;
    }

    .count-text-two {
        text-align: center;
        color: #99C691;
        font-weight: bold;
        font-size: 2rem;
    }

    a {
        text-decoration: none;
    }

    &:hover {
        transform: scale(1.05);
        cursor: pointer;
       
    }

}
.my-vh {
  height: calc(100vh - 123px);
}
</style>