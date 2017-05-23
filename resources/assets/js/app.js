
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.eventBus = new Vue();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('request-appointment', require('./components/request-appointment.vue'));
Vue.component('admin-dashboard', require('./components/admin-dashboard.vue'));
Vue.component('pending-appointments', require('./components/pending-appointments.vue'));
Vue.component('create-appointment-panel', require('./components/create-appointment-panel.vue'));
Vue.component('appointments', require('./components/appointments.vue'));
Vue.component('display-appointment', require('./components/display-appointment.vue'));

const app = new Vue({
    el: '#app'
});
