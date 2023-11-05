<script lang="ts">
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend,
  Filler
} from 'chart.js'
import 'chartjs-plugin-annotation';
import { store } from '../store.js';
import { Line } from 'vue-chartjs'


ChartJS.register(
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend,
  Filler
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
          backgroundColor: 'rgba(0, 128, 255, 0.5)',
          data: [],
          borderColor: 'aqua',
          fill: 'start'
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
    console.log(this.store.totalForMonth, 'TEST')
  }
}
</script>

<template>
  <Line :data="data" :options="options" />
</template>
