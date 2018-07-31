require('./bootstrap');
window.Vue = require('vue');

import Croppa from 'vue-croppa';
Vue.use(Croppa);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('nav-bar', require('./components/NavBar.vue'));
Vue.component('meta-footer', require('./components/MetaFooter.vue'));
Vue.component('csun-footer', require('./components/CsunFooter.vue'));
Vue.component('loading-button', require('./components/LoadingButton.vue'));
Vue.component('login-form', require('./components/LoginForm.vue'));
Vue.component('user-profile', require('./views/UserProfile.vue'));
Vue.component('info-form', require('./components/InfoForm.vue'));
Vue.component('image-upload', require('./components/ImageUpload.vue'));
Vue.component('pop-up-alert', require('./components/PopUpAlert.vue'));

const app = new Vue({
    el: '#app'
});
