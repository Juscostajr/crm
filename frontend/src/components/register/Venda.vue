<template>
    <el-dialog title="Venda" :visible.sync="modal" width="80%">
        <el-form :model="formulario">

            <el-row :gutter="15">
                <el-col :span="16">
                    <b>Razão Social</b> {{formulario.pessoaJuridica.razaoSocial}}
                </el-col>
                <el-col :span="8">
                    <b>Nome Fantasia</b> {{formulario.pessoaJuridica.nomeFantasia}}
                </el-col>
            </el-row>
            <br/><br/>
            <el-steps :space="255" :active="etapas.indexOf(formulario.etapa)" align-center>
                <el-step v-for="etapa in etapas" :key="etapa" :title="etapa"></el-step>
            </el-steps>

            <el-row>
                <el-col :span="24">
                    <el-form-item label="Interesses">
                        <br>
                        <el-checkbox v-for="servico in servicos" :key="servico.id" :label="servico.descricao" border v-model="interesses" size="small" /></el-checkbox>
                    </el-form-item>
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
                <el-col :span="12">
                    <el-select v-model="formulario.etapa">
                        <el-option v-for="(etapa,index) in etapas" :key="index" :value="etapa"></el-option>
                    </el-select>
                </el-col>
            </el-row>

            <registrar-interacao @interacao-saved="interacaoCallBack" :visible.sync="interacaoVisible" :datamodel="{tipo:interacaoTipo}" :pj="formulario.pessoaJuridica"></registrar-interacao>
        </el-form>
        <span slot="footer" class="dialog-footer">
            <el-button @click="modal = false">Cancelar</el-button>
            <el-button type="primary" @click="save">Salvar</el-button>
        </span>
    </el-dialog>
</template>
<script>
import Usuario from './Usuario.vue';
import RemoteSelect from '../RemoteSelect.vue';
import RegistrarInteracao from './Interacao.vue';
export default {
    props: ['visible', 'datamodel'],
    data() {
        return {
            form: {
                servico: []
            },
            formulario: {
                id: '',
                pessoaJuridica: {
                    razaoSocial: '',
                    nomeFantasia: '',
                },
                etapa: '',
                interacaos: []
            },
            dialogFormVisible: true,
            interacaoVisible: false,
            innerVisible: false,
            modal: false,
            perfis: [],
            etapas: [],
            servicos: [],
            vendas: [],
            interesses: [],
            interacaoTipo: 'Telefonema'
        }
    },
    watch: {
        modal() {
            this.$emit('update:visible', this.modal)
        },
        visible() {
            this.modal = this.visible;
        },
        datamodel() {
            if (this.datamodel == null) return this.clearForm();
            this.formulario = this.datamodel;
            this.interesses = this.formulario.interesses.map(value => { return value.descricao });
        }
    },
    components: { RemoteSelect, RegistrarInteracao }
    ,
    methods: {
        save() {
            this.formulario.interesses = this.interesses.map(interesse => {
                return this.servicos.find(obj => obj.descricao == interesse);
            });


                        this.$request.put(`venda/${this.formulario.id}`, this.formulario)
                            .then(response => {
                                this.clearForm();
                                this.dialogFormVisible = false;
                                this.$notify({
                                    title: 'Sucesso!',
                                    message: 'Usuario salvo corretamente',
                                    type: 'success'
                                });
                            })
                            .catch(error => {
                                console.log(error);
                                this.$notify.error({
                                    title: 'Erro!',
                                    message: 'Não foi possível cadastrar o usuário, consulte a área de sistemas'
                                });
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
            console.log(this.formulario);
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