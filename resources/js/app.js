require('./bootstrap');
window.Vue = require('vue');

import Vue from 'vue';
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js'
import  router from './Router/router';
import './pages/globalsass.sass'

import './Helpers/index.css'
import User from './Helpers/User';
window.User = User;

// import Exception from './Helpers/Exception';
// window.Exception =Exception;

import store from './Store';

import VueSimpleAlert from "vue-simple-alert";

Vue.use(VueSimpleAlert);

Vue.use(Vuetify);
window.EventBus = new Vue();
import OtpInput from "@bachdgvn/vue-otp-input";
import DatePicker from './components/Basic/UI/DatePicker'
import DatePickers from './components/Basic/UI/DatePickers'
import VueMomentsAgo from 'vue-moments-ago'
Vue.component("vue-moments-ago", VueMomentsAgo);
Vue.component("date-picker", DatePicker);
Vue.component("date-pickers", DatePickers);
Vue.component("v-otp-input", OtpInput);
Vue.component('main-app', require('./components/MainApp.vue').default);
Vue.component('second-app', require('./components/SecondApp').default);
Vue.component('notification-list', require('./components/notification/Notification_lists').default);

import VueObserveVisibility from 'vue-observe-visibility'
Vue.use(VueObserveVisibility);


import loader from "vue-ui-preloader";

Vue.use(loader);




const app = new Vue({
    el: '#app',
    router,
    loader:loader,
    store,
    vuetify: new Vuetify(),
    data: () => ({ isMobile: false }),
    beforeDestroy () {
        if (typeof window === 'undefined') return;
        window.removeEventListener('resize', this.onResize, { passive: true })
    },

    mounted () {
        this.onResize();

        window.addEventListener('resize', this.onResize, { passive: true })
    },

    methods: {
        onResize () {
            this.isMobile = window.innerWidth < 600
        },
    },

});











// const apps = new Vue({
//     el: '#app1',
//     router,
//     loader:loader,
//     store,
//     vuetify: new Vuetify(),
//     data: () => ({ isMobile: false }),
//     beforeDestroy () {
//         if (typeof window === 'undefined') return;
//         window.removeEventListener('resize', this.onResize, { passive: true })
//     },
//
//     mounted () {
//         this.onResize();
//
//         window.addEventListener('resize', this.onResize, { passive: true })
//     },
//
//     methods: {
//         onResize () {
//             this.isMobile = window.innerWidth < 600
//         },
//     },
//
// });
