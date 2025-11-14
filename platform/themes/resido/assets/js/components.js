/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other plugins. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

"use strict";

import PropertyComponent from './components/PropertyComponent';
import NewsComponent from './components/NewsComponent';
import sanitizeHTML from 'sanitize-html';
import { createApp } from 'vue';
import FeaturedAgentsComponent from './components/FeaturedAgentsComponent';
import TestimonialsComponent from './components/TestimonialsComponent';
import RealEstateReviewsComponent from './components/RealEstateReviewsComponent';

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = createApp({});

app.component('property-component', PropertyComponent);
app.component('news-component', NewsComponent);
app.component('featured-agents-component', FeaturedAgentsComponent);
app.component('testimonials-component', TestimonialsComponent);
app.component('real-estate-reviews-component', RealEstateReviewsComponent);

/**
 * This let us access the `__` method for localization in VueJS templates
 * ({{ __('key') }})
 */
app.config.globalProperties.__ = key => {
    return window.trans[key] !== 'undefined' ? window.trans[key] : key;
};

app.config.globalProperties.themeUrl = url => {
    return window.themeUrl + '/' + url;
}

app.config.globalProperties.$sanitize = sanitizeHTML;

app.directive('slick', {
    mounted: function (element) {
        $(element).slick({
            slidesToShow: 3,
            infinite: true,
            rtl: $('body').prop('dir') === 'rtl',
            arrows: false,
            autoplay: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        slidesToShow: 1
                    }
                }
            ]
        });
    },
});

app.mount('#app');
