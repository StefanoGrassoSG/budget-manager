import { createApp } from 'vue'
import './assets/scss/style.scss'
import axios from 'axios';
import App from './App.vue'
import Cookies from 'js-cookie';
// Import all of Bootstrap's JS
import * as bootstrap from 'bootstrap'
import { router } from './router';
import PulseLoader from 'vue-spinner/src/PulseLoader.vue'
createApp(App).use(router).mount('#app')




