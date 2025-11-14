/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import ActivityLogComponent from './components/dashboard/ActivityLogComponent';
import PackagesComponent from './components/dashboard/PackagesComponent';
import PaymentHistoryComponent from './components/dashboard/PaymentHistoryComponent';
import FacilitiesComponent from './components/FacilitiesComponent';
import { createApp } from 'vue';

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import sanitizeHTML from 'sanitize-html';

const app = createApp({});

app.component('activity-log-component', ActivityLogComponent);
app.component('packages-component', PackagesComponent);
app.component('payment-history-component', PaymentHistoryComponent);
app.component('facilities-component', FacilitiesComponent);

/**
 * This let us access the `__` method for localization in VueJS templates
 * ({{ __('key') }})
 */
app.config.globalProperties.__ = (key) => {
    return window.trans[key] !== 'undefined' ? window.trans[key] : key;
};

app.config.globalProperties.$sanitize = sanitizeHTML;

app.mount('#app-real-estate');
