import './bootstrap';

import '~resources/scss/app.scss';

import * as bootstrap from 'bootstrap';

import.meta.glob([
    '../img/**'
]);

import axios from 'axios';

axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
