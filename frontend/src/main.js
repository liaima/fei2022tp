import Vue from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify'
import custom_axios from '@/plugins/axios'
import router from '@/plugins/router'

Vue.config.productionTip = false

new Vue({
  vuetify,
  custom_axios,
  router,
  render: h => h(App)
}).$mount('#app')
