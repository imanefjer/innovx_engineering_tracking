import axios from 'axios';
window.axios = axios;
window.$ = require('jquery');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
