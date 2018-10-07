import Vue from "vue";
import ElementUI from "element-ui";
import locale from "element-ui/lib/locale/lang/pt-br";
import Router from "vue-router";
import 'element-ui/lib/theme-chalk/index.css';
import {routes} from './routes';
import VInputmask from 'v-inputmask';
import Axios from 'axios';
import AxiosAdapter from 'axios-jsonp';
import GoogleMapsLoader from 'google-maps';
Vue.use(Router);
Vue.use(ElementUI, { locale });
Vue.use(VInputmask);

import App from "./App.vue";

const router = new Router({routes});
Vue.filter('capitalize', function (value) {
    if (!value) return ''
    value = value.toString()
    return value.charAt(0).toUpperCase() + value.slice(1)
});
Vue.prototype.$request = Axios.create({
    baseURL: 'http://localhost:8080/',
    timeout: 10000,
});
Vue.prototype.$cnpj = Axios.create({
    baseURL: 'https://www.receitaws.com.br/v1/cnpj/',
    timeout: 10000,
    headers: {
        'Content-Type' : 'application/json'
    },
    adapter: AxiosAdapter
});

Vue.prototype.$viacep = Axios.create({
    baseURL: 'https://viacep.com.br/ws/',
    timeout: 10000,
});




new Vue({
    router,
    el: '#app',
    render: h => h(App)
});
