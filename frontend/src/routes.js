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

export const routes = [
  { path: "/", component: Home },
  { path: "/prevenda", component: Prevenda },
  { path: "/venda", component: Venda },
  { path: "/posvenda", component: Posvenda },
  { path: "/empresa", component: Empresa },
  { path: "/pf", component: PessoaFisica },
  { path: "/grupo", component: Grupo },
  { path: "/usuario", component: Usuario },
  { path: "/operadora", component: Operadora },
  { path: "/perfil", component: Perfil },
  { path: "/servico", component: Servico },
  { path: "/secao", component: Secao },
  { path: "/tipoGrupo", component: TipoGrupo },  
  { path: "/registrarVisita", component: RegistrarVisita },
  
];
