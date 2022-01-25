require('./bootstrap');


import { createApp } from 'vue'
import App from './App.vue'; 

import router from "./routes/routes";


const app = createApp(App).use(router);

app.mount('#app');
