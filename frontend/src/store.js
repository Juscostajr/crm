import Vue from "vue";
import Vuex from "vuex";
import Axios from "axios";

Vue.use(Vuex);

const crma = Axios.create({
  baseURL: "http://localhost:8080/",
  timeout: 10000
});

const state = {
  usuario: {
    login: ""
  }
};

const mutations = {
  setUsuario(state, usuario) {
    state.usuario = usuario;
  }
};

const actions = {
  login(context, data) {
    crma.post("auth", data).then(response => {
      context.commit("setUsuario", response.data);
    });
  }
};
export default new Vuex.Store({
  state,
  mutations,
  actions
});
