import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'  
import axios from 'axios'
import moment from 'moment'
import './assets/css/style.css'
import { BootstrapVue } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.config.productionTip = false


Vue.filter('formatDate', function(value) {
  if (value) {
    return moment((value)).format("MMM Do YY")
  }
});

Vue.prototype.$http = axios

Vue.use(BootstrapVue)

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
