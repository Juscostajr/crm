import Vue from "vue";
import Router from "vue-router";
import Prevenda from "./pages/Prevenda.vue";
import Venda from "./pages/Venda.vue";
import Posvenda from "./pages/Posvenda.vue";
import Empresa from "./pages/Empresa.vue";
import PessoaFisica from "./pages/PessoaFisica.vue";
import Grupo from "./pages/Grupo.vue";
import Usuario from "./pages/Usuario.vue";
import Operadora from "./pages/Operadora.vue";
import Perfil from "./pages/Perfil.vue";
import Servico from "./pages/Servico.vue";
import Secao from "./pages/Secao.vue";
import TipoGrupo from "./pages/TipoGrupo.vue";
import RegistrarVisita from "./pages/RegistrarVisita.vue";
import Campanha from "./pages/Campanha.vue";
import TabelaPreco from "./pages/TabelaPreco.vue";

Vue.use(Router);

let routes = new Router({
  routes: [
    { path: "/prevenda", component: Prevenda },
    { path: "/venda", component: Venda},
    { path: "/posvenda", component: Posvenda },
    { path: "/pj", component: Empresa },
    { path: "/pf", component: PessoaFisica },
    { path: "/grupo", component: Grupo },
    { path: "/usuario", component: Usuario },
    { path: "/operadora", component: Operadora },
    { path: "/perfil", component: Perfil },
    { path: "/servico", component: Servico },
    { path: "/secao", component: Secao },
    { path: "/tipoGrupo", component: TipoGrupo },
    { path: "/registrarVisita", component: RegistrarVisita },
    { path: "/campanha", component: Campanha },
    { path: "/tabelaPreco", component: TabelaPreco }
  ]
});

routes.beforeEach((to, from, next) => {
  let authRoutes = JSON.parse(localStorage.getItem("session")).acessos.map(
    rota => `/${rota.rota}`
  );
  console.log(authRoutes);
  console.log(to.path);
  
  if(authRoutes.includes('/venda')){
    authRoutes.push('/prevenda');
    authRoutes.push("/posvenda");
    authRoutes.push('/registrarVisita');
  }

  if (authRoutes.includes(to.path)) {
    return next();
  }
  next(false);
});

export default routes;
