import '@/bootstrap';
import {createApp} from 'vue';
import {createPinia} from 'pinia';
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate';
import App from '@/pages/App.vue';
import router from '@/router';
import 'vuetify/styles';
import '@mdi/font/css/materialdesignicons.css';
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';

const vuetify = createVuetify({
    components,
    directives,
})

const pinia = createPinia();
pinia.use(piniaPluginPersistedstate);
const app = createApp(App);

app.use(pinia);
app.use(router);
app.use(vuetify);
app.mount('#app');
