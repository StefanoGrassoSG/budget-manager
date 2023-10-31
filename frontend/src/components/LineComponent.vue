<script lang="ts">
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend
} from 'chart.js'
import { store } from '../store.js';
import { Line } from 'vue-chartjs'


ChartJS.register(
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend
)

export default {
  name: 'App',
  components: {
    Line
  },
  data() {
    return {
      data: {
        labels: [],
        datasets: [
        {
          label: 'Spese',
          backgroundColor: 'darkblue',
          data: []
        }
        ]
      },
    options: {
      responsive: true,
      maintainAspectRatio: false,
    },
    store
    }
  },
  created() {
    this.data.labels = this.store.months.map(item => item.month_year);
    this.data.datasets[0].data = this.store.totalForMonth.map(item => item.total_expenses);
  }
}
</script>

<template>
  <Line :data="data" :options="options" />
</template>
