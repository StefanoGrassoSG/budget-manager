<script lang="ts">
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'
import { Doughnut } from 'vue-chartjs'
import { store } from '../store.js';

ChartJS.register(ArcElement, Tooltip, Legend)

export default {
  name: 'App',
  components: {
    Doughnut,
  },
  data() {
    return {
      data: {
        labels: [],
        datasets: [
          {
            backgroundColor: ['#41B883', 'yellow', 'orange', 'red', 'blue', 'purple', 'aqua', 'darkred', 'lime', 'black'],
            data: []
          }
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
      },
      store
    }
  },
  created() {
    const valoriArray = this.store.expenseCalc;
    const valoriPredefiniti = Array(10);
      for (let i = 0; i <= 9; i++) {
        valoriPredefiniti[i - 1] = valoriArray[i] || 0;
      }
    const valoriArrayCategorie = this.store.categories;
    const NuoviValoriCategorie = valoriArrayCategorie.map(obj => obj.name);
    const ArrayFinale = Array(10);;
      for (let index = 1; index < 11; index++) {
        ArrayFinale[index] = NuoviValoriCategorie[index -  1];
      }
    this.data.datasets[0].data = valoriPredefiniti;
   
    for (let index = 1; index < ArrayFinale.length; index++) {
      this.data.labels.push(ArrayFinale[index])
    }
  },
};
</script>

<template>
  <Doughnut :data="data" :options="options" />
</template>