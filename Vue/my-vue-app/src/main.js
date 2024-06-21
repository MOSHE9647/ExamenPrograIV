import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import Toast from 'vue-toastification'
import 'vue-toastification/dist/index.css'
import 'bootstrap/dist/css/bootstrap.min.css';

createApp(App)
  .use(router)
  .use(Toast, {
    transition: "Vue-Toastification__bounce",
    maxToasts: 20,
    newestOnTop: true
  })
  .mount('#app');
