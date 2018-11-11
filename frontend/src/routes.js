import Home from "./pages/Home.vue";
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
import Campanha from './pages/Campanha.vue';
import Axios from "axios";

export const routes = [
  { path: "/prevenda", component: Prevenda, method: "venda" },
  { path: "/venda", component: Venda, method: "venda" },
  { path: "/posvenda", component: Posvenda, method: "interacao" },
  { path: "/empresa", component: Empresa, method: "pj" },
  { path: "/pf", component: PessoaFisica, method: "pf" },
  { path: "/grupo", component: Grupo, method: "grupo" },
  { path: "/usuario", component: Usuario, method: "usuario" },
  { path: "/operadora", component: Operadora, method: "operadora" },
  { path: "/perfil", component: Perfil, method: "perfil" },
  { path: "/servico", component: Servico, method: "servico" },
  { path: "/secao", component: Secao, method: "secao" },
  { path: "/tipoGrupo", component: TipoGrupo, method: "tipogrupo" },
  { path: "/registrarVisita", component: RegistrarVisita, method: "venda" },
  { path: "/campanha", component: Campanha, method: "campanha" }
];
/** 
export default {
  getRoutes: (user ) => {
    
    let userProfiles = user.perfils;
    let filteredArray = userProfiles.map(profile => {
      return profile.acessos.map(acesso => {
        return acesso.entidade;
      });
    });

    filteredArray = [].concat.apply([], filteredArray);

    return views
      .filter(view => {
        return filteredArray.includes(view.method);
      })
      .map(route => {
        return { path: route.path, method: route.component };
      });
  }
};
*/