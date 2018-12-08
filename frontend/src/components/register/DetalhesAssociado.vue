<template>
    <el-dialog :title="formulario.razaoSocial" :visible.sync="modal" width="80%" append-to-body>
        <el-form :model="formulario">

            <el-row :gutter="15">
                <el-col :span="16">
                    <b>Razão Social</b> {{formulario.razaoSocial}}
                </el-col>
                <el-col :span="8">
                    <b>Nome Fantasia</b> {{formulario.nomeFantasia}}
                </el-col>
            </el-row>
            <el-row>
                <el-col :span="24">
                    <h3>Interações</h3>
                    <el-row v-for="interacao in formulario.interacaos" :key="interacao.id" :gutter="15">
                        <el-row>
                            <el-col :span="1">
                                <icon name="phone" v-if="interacao.tipo == 'Telefonema'" :scale="2.5" />
                                <icon name="envelope" v-if="interacao.tipo == 'Email'" :scale="2.5" />
                                <icon name="user" v-if="interacao.tipo == 'Visita'" :scale="2.5" />
                            </el-col>
                            <el-col :span="23"><hr /></el-col>
                        </el-row>
                        <el-row :gutter="15">
                            <el-col :span="7">
                                <el-form-item label="Data">
                                    <el-date-picker v-model="interacao.data" format="dd/MM/yyyy" readonly></el-date-picker>
                                </el-form-item>
                            </el-col>
                            <el-col :span="7">
                                <el-form-item label="Hora">
                                    <el-time-picker v-model="interacao.hora" readonly></el-time-picker>
                                </el-form-item>
                            </el-col>
                            <el-col :span="10">
                                <el-form-item label="Usuário">
                                    <el-input v-model="interacao.usuario.pessoa.nome" readonly></el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <h4>Anotações</h4>
                        <el-row :gutter="15" v-for="anotacao in interacao.anotacaos" :key="anotacao.id">
                            <el-col :span="4">
                                <el-form-item label="Data">
                                    <el-date-picker v-model="anotacao.data" format="dd/MM/yyyy" readonly />
                                </el-form-item>
                            </el-col>
                            <el-col :span="3">
                                <el-form-item label="Hora">
                                    <el-time-picker v-model="anotacao.hora" readonly />
                                </el-form-item>
                            </el-col>
                            <el-col :span="7">
                                <el-form-item label="Título">
                                    <el-input v-model="anotacao.titulo" readonly />
                                </el-form-item>
                            </el-col>
                            <el-col :span="10">
                                <el-form-item label="Descrição">
                                    <el-input v-model="anotacao.descricao" readonly />
                                </el-form-item>
                            </el-col>
                        </el-row>

                    </el-row>
                </el-col>
            </el-row>

            <hr/>
            <el-row :gutter="15">
                <el-col :span="12">
                    <el-button type="primary" @click="showInteracaoView('Telefonema')">
                        <icon name="phone"></icon> Registrar Telefonema</el-button>
                    <el-button type="primary" @click="showInteracaoView('Email')">
                        <icon name="envelope"></icon> Registrar Email</el-button>
                    <el-button type="primary" @click="showInteracaoView('Visita')">
                        <icon name="user-tie"></icon> Registrar Visita</el-button>
                </el-col>
            </el-row>
            <registrar-interacao @interacao-saved="interacaoCallBack" :visible.sync="interacaoVisible" :datamodel="{tipo:interacaoTipo}" :pj="formulario"></registrar-interacao>
        </el-form>
        <span slot="footer" class="dialog-footer">
            <el-button @click="modal = false">Fechar</el-button>
           
            </span>
        </span>
    </el-dialog>
</template>
<script>
import Usuario from './Usuario.vue';
import RemoteSelect from '../RemoteSelect.vue';
import RegistrarInteracao from './Interacao.vue';
import Associado from './Associado.vue';
export default {
    props: ['visible', 'associadoModel'],
    data() {
        return {
            formulario: {
                    id: '',
                    razaoSocial: '',
                    nomeFantasia: '',
                    interacaos: [],
            },
            dialogFormVisible: true,
            interacaoVisible: false,
            innerVisible: false,
            modal: false,
            perfis: [],
            interacaoTipo: 'Telefonema'
        }
    },
    watch: {
        modal() {
            this.$emit('update:visible', this.modal)
        },
        visible() {
            this.modal = this.visible;
            if(this.visible){
                this.init();
            }
        },
    },
    components: { RemoteSelect, RegistrarInteracao, Associado }
    ,
    methods: {
        save() {
            this.formulario.interesses = this.interesses.map(interesse => {
                return this.servicos.find(obj => obj.descricao == interesse);
            });
        },
        create(){
            this.formulario.interesses = this.interesses.map(interesse => {
                return this.servicos.find(obj => obj.descricao == interesse);
            });

        },
        clearForm() {
            this.form = {}
        },
        showInteracaoView(tipo) {
            this.interacaoTipo = tipo;
            this.interacaoVisible = true;
        },
        interacaoCallBack(data) {
            this.formulario.interacaos.push(data);
        },
        init(){
            if (this.associadoModel == null) return this.clearForm();

            if (this.associadoModel.hasOwnProperty('id')){
                this.formulario = this.associadoModel;
            } else {
                this.loadAssociado(this.associadoModel.pessoaJuridica);
            }
            
        },
        loadAssociado(pessoaJuridica){
            this.$request.get(`associado/pessoa/${pessoaJuridica.id}`)
                .then(response => {
                    this.formulario = response.data;
                    console.log(response.data);
                });
        }
    },
    mounted() {
        this.$request.get('servico')
            .then(response => {
                this.servicos = response.data;
            })

        this.$request.get('etapa')
            .then(response => {
                this.etapas = response.data;
            })
    },
}

</script>
<style>
hr {
    margin: 1.5em 0;
}

.el-steps {
    margin: 50px 0;
}
</style>