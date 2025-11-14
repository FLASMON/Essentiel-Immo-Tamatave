import { createApp } from 'vue';
import RepeaterComponent from './form/fields/RepeaterComponent';

const app = createApp({});

app.config.globalProperties.__ = key => {
    return _.get(window.trans, key, key);
};

app.component('repeater-component', RepeaterComponent);

app.mount('#main');
