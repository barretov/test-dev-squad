require('./bootstrap');
window.Vue = require('vue');

import App from './components/App'
import axios from 'axios'
import VModal from 'vue-js-modal'

Vue.use(VModal, { dialog: true }),

new Vue({
	el: '#app',
	components: {App}
});
