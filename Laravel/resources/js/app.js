require('./bootstrap');

import axios from 'axios';

axios.defaults.baseURL = window.Laravel.apiBaseUrl;
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.axios = axios;