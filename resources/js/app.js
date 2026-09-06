require('./bootstrap');
import DataTable from 'laravel-vue-datatable'
import Vue from 'vue';

window.Vue = require('vue');
Vue.use(DataTable)

Vue.component('user-component', require('./components/user/UserComponent.vue').default);

const app = new Vue({
    el: '#app',
});
