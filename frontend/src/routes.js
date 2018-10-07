import Home from "./pages/Home.vue";
import Prevenda from "./pages/Prevenda.vue";
import Venda from "./pages/Venda.vue";
import Posvenda from "./pages/Posvenda.vue";
import Empresa from "./pages/Empresa.vue";
import PessoaFisica from "./pages/PessoaFisica.vue";

export const routes = [
  { path: "/", component: Home },
  { path: "/prevenda", component: Prevenda },
  { path: "/venda", component: Venda },
  { path: "/posvenda", component: Posvenda },
  { path: "/empresa", component: Empresa },
  { path: "/pf", component: PessoaFisica },
];
