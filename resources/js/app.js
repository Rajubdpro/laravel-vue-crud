require('./bootstrap');

import { createApp } from 'vue'
import App from './App.vue'; 

import router from "./routes/routes";


const myMixin = {
    data() {
      return {
        base_url: 'http://127.0.0.1:8000',
        upload_path: 'http://127.0.0.1:8000/uploads/',
      }
    }
  }

const app = createApp(App).use(router);
app.mixin(myMixin);
app.mount('#app');
