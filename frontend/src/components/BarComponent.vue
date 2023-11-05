<template>
    <Bar :data="data" :options="options" />
  </template>
  
  <script lang="ts">
  import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale
  } from 'chart.js'
  import { Bar } from 'vue-chartjs'
  import { store } from '../store.js';

  
  ChartJS.register(CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend)
  
  export default {
    name: 'App',
    components: {
      Bar
    },
    data() {
      return  {
      data: {
        labels: [],
        datasets: [
        {   
            label: 'Spese giornaliere',
            backgroundColor: 'aquamarine',
            borderColor: 'red',
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
        this.data.labels = this.getDaysInMonth()
        this.data.datasets[0].data = this.amountEachDay()
        console.log(this.data.datasets[0].data, 'BAR DATA')
    },
    methods: {
        getDaysInMonth() {
            const currentDate = new Date();
            const year = currentDate.getFullYear(); 
            const month = currentDate.getMonth(); 
            const nextMonthFirstDay = new Date(year, month + 1, 1);
            const lastDayOfMonth = new Date(nextMonthFirstDay - 1);
            const numberOfDays = lastDayOfMonth.getDate();
            console.log('Il mese corrente ha ' + numberOfDays + ' giorni.');

            const days = [];
            for (let day = 1; day <= numberOfDays; day++) {
                days.push(day);
            }

            return days;
        },
        amountEachDay() {
            const amounts = [];
            this.store.eachdays.forEach(element => {
                amounts.push(element.total_amount)
            });
            return amounts
        }
    }
  }
  </script>
  