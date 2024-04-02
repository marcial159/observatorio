import './bootstrap'
import {createApp} from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import Store from './store/index.js'
import Router from './routes/index.js'
import Notifications from '@kyvg/vue3-notification'
import Multiselect from '@vueform/multiselect'
import vuenisimo from './components/helper/vuenisimo.js'
import App from '../js/app.vue'

const app = createApp( App )

app.provide( 'vuenisimo', vuenisimo )
app.use(Notifications)
app.use(Multiselect)
app.use(VueAxios, axios)
app.use(Store)
app.use(Router)

app.mount('#app')

// =============================================================
// * Nombre de la app
app.config.globalProperties.$name = 'Flask'
// * Uri a usar
app.config.globalProperties.$uri = 'http://localhost:8000/api'
//app.config.globalProperties.$uri = 'https://unamba.com/api'
// =============================================================