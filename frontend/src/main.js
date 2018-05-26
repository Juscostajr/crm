import Vue from "vue";
import ElementUI from "element-ui";
import Router from "vue-router";
import 'element-ui/lib/theme-chalk/index.css';
import {routes} from './routes'
Vue.use(Router);
Vue.use(ElementUI);

import App from "./App.vue";

const router = new Router({routes});

new Vue({
    router,
    el: '#app',
    render: h => h(App)
});
