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
    const valoriArray = Object.values(this.store.expenseCalc);
    const valoriPredefiniti = Array(10).fill(0);
    valoriArray.forEach((valore, indice) => {
    valoriPredefiniti[indice] = valore;
    });
    this.data.labels = this.store.categories.map(item => item.name);
    this.data.datasets[0].data = valoriPredefiniti;
  },
};
</script>

<template>
  <Doughnut :data="data" :options="options" />
</template>