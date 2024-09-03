require('./bootstrap');



window.Vue = require('vue');

Vue.component('reportes-component', require('./components/ReportesComponent.vue').default);

const app = new Vue({
    el: '#app',
});
