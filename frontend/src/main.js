import Vue from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify'
import axios from '@/plugins/axios'
import router from '@/plugins/router'
import VueAxios from 'vue-axios'

Vue.config.productionTip = false
Vue.use(VueAxios, axios);

new Vue({
  vuetify,
  router,
  render: h => h(App)
}).$mount('#app')
