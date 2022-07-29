require('./bootstrap');
import { createApp } from 'vue';
import App from './components/home/App.vue';
import 'vuesax/dist/vuesax.css';
import router from './routes';

const app = createApp(App).use(router)
app.mount('#app')
