require('./bootstrap');
window.Vue = require('vue');
import App from './components/App'
import VModal from 'vue-js-modal'

Vue.use(VModal, { dialog: true })

new Vue({
	el: '#app',
	template: '<App/>',
	components: { App },
});
