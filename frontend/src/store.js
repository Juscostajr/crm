import Vue from 'vue';
import Vuex from 'vuex';
import Axios from 'axios';

Vue.use(Vuex);

const crma = 
    Axios.create({
    baseURL: 'http://localhost:8080/',
    timeout: 10000,
});

const state = {
    views: 'tabela',
    model: {
        empresa: {
            razaoSocial: '',
                telefones: [{
                    numero: '',
                    proprietario: '',
                    operadora: {
                        id: '',
                        nome: '',
                    },
                    tipo: ''
                }],
                enderecos: [],
                email: {
                    email: '',
                },
                grupos: [],
                nomeFantasia: '',
                inscricaoEstadual: {
                    numero: ''
                },
                cnpj: {
                    numero: ''
                },
                numeroFuncionarios: '',
                representanteLegal: '',
                ramoAtividade: {}
        }
    },
    servicos: [],
    register: {
        pj: false,
    },
}

const mutations = {
    'set-servicos'(state,servicos){
        state.servicos = servicos;
    },
    'set-modal'(state,args){
        state.register[args.name] = args.visible;
    },
    'set-empresa'(state){
    }
}

const actions = {
    'load-servicos'(context){
        crma.get("servico").then(response => {
            context.commit('set-servicos', response.data);
        });
    },
    'save-empresa'(context,data){
        crma.post('pj',data).then(response => {
            context.commit('set-empresa', response.data);
        });
    },
    'show-modal'(context,name){
        context.commit('set-modal', {name: name, visible:true});
    },
    'hide-modal'(context,name){
        context.commit('set-modal', {name: name, visible:false});
    },
    
}
export default new Vuex.Store({
    state, mutations, actions
});