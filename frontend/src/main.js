import Vue from "vue";
import ElementUI from "element-ui";
import locale from "element-ui/lib/locale/lang/pt-br";
import "element-ui/lib/theme-chalk/index.css";
import VInputmask from "v-inputmask";
import Axios from "axios";
import AxiosAdapter from "axios-jsonp";
import GoogleMapsLoader from "google-maps";
import "vue-awesome/icons";
import Icon from "vue-awesome/components/Icon.vue";
import Moment from "vue-moment";
import router from "./router";
import store from "./store";
import VueApexCharts from "vue-apexcharts";


Vue.use(ElementUI, { locale });
Vue.use(VInputmask);
Vue.use(Moment);
Vue.use(VueApexCharts);
Vue.component("apexchart", VueApexCharts);
import App from "./App.vue";

Vue.filter("capitalize", function(value) {
  if (!value) return "";
  value = value.toString();
  return value.charAt(0).toUpperCase() + value.slice(1);
});

Vue.filter("limit", function (value, limit) {
  if (!value) return "";
  value = value.toString();
  if(value.length >= limit) {
    return `${value.substr(0, limit - 4)}...`;
  }
  return value.substr(0,limit - 1);
});

Vue.component("icon", Icon);


Vue.prototype.$request = Axios.create({
  baseURL: "http://localhost:8080/",
  timeout: 20000,
  headers: {
    "Content-Type": "application/json"
  }
});

const session = JSON.parse(localStorage.getItem('session'));
if (session && session.hasOwnProperty('token')) {
  Vue.prototype.$request.defaults.headers.common['X-Token'] = session.token
}

Vue.prototype.$cnpj = Axios.create({
  baseURL: "https://www.receitaws.com.br/v1/cnpj/",
  timeout: 10000,
  headers: {
    "Content-Type": "application/json"
  },
  adapter: AxiosAdapter
});

Vue.prototype.$viacep = Axios.create({
  baseURL: "https://viacep.com.br/ws/",
  timeout: 10000,
  adapter: AxiosAdapter
});

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app');
