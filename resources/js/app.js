import '../css/app.css'
import { createApp } from 'vue'
import router from './router/index.js'
import App from './App.vue'       // import root

const app = createApp(App)        // createApp with root
app.use(router)                   // use router
app.mount('#app')                 // mount
