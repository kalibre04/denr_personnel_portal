/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;




/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('disapptravelored', require('./components/DisappTravelored.vue').default);
Vue.component('edittravelored', require('./components/EditTravelored.vue').default);
Vue.component('apptravelored', require('./components/AppTravelored.vue').default);
Vue.component('disapptravelaredts', require('./components/DisappTravelaredts.vue').default);
Vue.component('edittravelaredts', require('./components/EditTravelaredts.vue').default);
Vue.component('apptravelaredts', require('./components/AppTravelaredts.vue').default);
Vue.component('disapptravelpenro', require('./components/DisappTravelpenro.vue').default);
Vue.component('edittravelpenro', require('./components/EditTravelpenro.vue').default);
Vue.component('apptravelpenro', require('./components/AppTravelpenro.vue').default);
Vue.component('disapptravelaredms', require('./components/DisappTravelaredms.vue').default);
Vue.component('edittravelaredms', require('./components/EditTravelaredms.vue').default);
Vue.component('apptravelaredms', require('./components/AppTravelaredms.vue').default);
Vue.component('viewtravelcenro', require('./components/ViewTravelcenro.vue').default);
Vue.component('disapptravelcenro', require('./components/DisappTravelcenro.vue').default);
Vue.component('edittravelcenro', require('./components/EditTravelcenro.vue').default);
Vue.component('apptravelcenro', require('./components/AppTravelcenro.vue').default);
Vue.component('disapptraveldivchief', require('./components/DisappTraveldivchief.vue').default);
Vue.component('viewtravel', require('./components/ViewTravel.vue').default);
Vue.component('apptraveldivchief', require('./components/AppTraveldivchief.vue').default);
Vue.component('examplecomponent', require('./components/ExampleComponent.vue').default);
Vue.component('createtravel', require('./components/CreateTravel.vue').default);
Vue.component('edittraveldivchief', require('./components/EditTraveldivchief.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
