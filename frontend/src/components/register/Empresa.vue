<template>
    <el-dialog title="Cadastrar Empresa" :visible.sync="modal" width="80%">

        <el-form :model="form">
            <el-row :gutter="10">
                <el-col :span="8">
                    <el-form-item 
                    label="CNPJ" 
                    :rules="{ required: true, message: 'Informe um cnpj válido', trigger:'blur' }"
                    >
                        <el-input v-model="form.cnpj.numero" auto-complete="off" v-inputmask="'99.999.999/9999-99'" @blur="cnpjLoad()"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="16">
                    <el-form-item label="Razão Social">
                        <el-input v-model="form.razaoSocial" auto-complete="off"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="10">
                <el-col :span="8">
                    <el-form-item label="Nome Fantasia">
                        <el-input v-model="form.nomeFantasia" auto-complete="off"></el-input>
                    </el-form-item>
                </el-col>

                <el-col :span="8">
                    <el-form-item label="Inscr. Estadual">
                        <el-input v-model="form.inscricaoEstadual.numero" auto-complete="off"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Ramo de Ativid.">
                        <remote-select data-source="ramo" id="id" label="descricao" :model.sync="form.ramoAtividade"></remote-select>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="10">
                <el-col :span="10">
                    <el-form-item label="E-Mail">
                        <el-input type="email" v-model="form.email.email" auto-complete="off"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="5">
                    <el-form-item label="Funcionários">
                        <el-input-number :min="0" :max="10000" v-model="form.numeroFuncionarios" auto-complete="off"></el-input-number>
                    </el-form-item>
                </el-col>
                <el-col :span="9">
                    <el-form-item label="Representante Legal">
                        <remote-select data-source="pf" id="id" label="nome" :model.sync="form.representanteLegal"></remote-select>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="10">
                <el-col :span="12">
                    <el-form-item label="Telefones">
                        <el-row>
                            <el-col :span="24">
                                <el-row v-for="(telefone, index) in form.telefones" :gutter="10" :key="index">
                                    <el-col :span="18">
                                        <el-input v-model="telefone.numero" auto-complete="off" v-inputmask="'(99) 9999[9]-9999'">
                                            <el-select v-model="telefone.tipo" slot="prepend" placeholder="Tipo">
                                                <el-option v-for="tipo in telefoneTipos" :label="tipo | capitalize" :value="tipo" :key="tipo"></el-option>
                                            </el-select>

                                            <el-select v-model="telefone.operadora" value-key="id" slot="append" placeholder="Operadora">
                                                <el-option v-for="operadora in operadoras" :label="operadora.nome" :value="operadora" :key="operadora.id"></el-option>
                                            </el-select>
                                        </el-input>
                                    </el-col>
                                    <el-col :span="6">
                                        <el-button-group>
                                            <el-button type="success" icon="el-icon-plus" @click="addTelefone"></el-button>
                                            <el-button type="danger" icon="el-icon-delete" v-if="index > 0" @click.prevent="removeTelefone(telefone)"></el-button>
                                        </el-button-group>
                                    </el-col>
                                </el-row>
                            </el-col>
                        </el-row>
                    </el-form-item>
                </el-col>
                <el-col :span="12">
                    <el-form-item label="Grupos">
                        <remote-select-multiple data-source="grupo" id="id" label="descricao" :model.sync="form.grupos"></remote-select-multiple>
                    </el-form-item>
                    <el-form-item label="Enderecos">
                        <br>
                        <el-button type="success" icon="el-icon-plus" size="small" @click="innerVisible = true">
                            Adicionar
                        </el-button>
                        <endereco :isVisible.sync="innerVisible" :enderecos.sync="form.enderecos"></endereco>
                    </el-form-item>
                </el-col>
            </el-row>
        </el-form>
        <span slot="footer" class="dialog-footer">
            <el-button @click="modal = false">Cancelar</el-button>
            <el-button type="primary" @click="save">Salvar</el-button>
        </span>
    </el-dialog>
</template>
<script>
import axios from 'axios';
import Endereco from './Endereco.vue';
import RemoteSelect from '../RemoteSelect.vue';
import RemoteSelectMultiple from '../RemoteSelectMultiple.vue';
export default {
    props: ['visible','datamodel'],
    data() {
        return {
            formLabelWidth: '120px',
            form: {
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
            },
            dialogFormVisible: true,
            showTelefone: false,
            innerVisible: false,
            formEndereco: {},
            telefoneTipos: [],
            operadoras: [],
            enderecos: [],
            modal: false,

        }
    },
    mounted() {
        this.$request.get('telefone')
            .then(response => {
                this.telefoneTipos = response.data;
            })
            .catch(function(error) {
                console.log(error);
                this.$notify.error({
                    title: 'Erro!',
                    message: 'Não foi possível carregar os tipos de telefone'
                });
            });
        this.$request.get('operadora')
            .then(response => {
                this.operadoras = response.data;
            })
            .catch(error => {
                console.log(error);
                this.$notify.error({
                    title: 'Erro!',
                    message: 'Não foi possível carregar as operadoras de telefone'
                });
            });
    },
    watch: {
        modal() {
            this.$emit('update:visible', this.modal)
        },
        visible() {
            this.modal = this.visible;
        },
        datamodel() {
            if(this.datamodel == null) return this.clearForm();
            this.form = this.datamodel;
        }
    },
    components: { Endereco, RemoteSelect, RemoteSelectMultiple }
    ,
    methods: {
        save() {
            this.$request.post('pj', this.form)
                .then(response => {
                    this.modal = false;
                    this.$notify({
                        title: 'Sucesso!',
                        message: 'Empresa salva corretamente',
                        type: 'success'
                    });
                    this.$emit('empresa-callback', this.form);
                    this.clearForm();
                })
                .catch(error => {
                    console.log(error);
                    this.$notify.error({
                        title: 'Erro!',
                        message: 'Não foi possível cadastrar a empresa, consulte a área de sistemas'
                    });
                });
        }
        ,
        clearForm() {
            this.form = {
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
            };
        }
        ,
        removeTelefone(item) {
            var index = this.form.telefones.indexOf(item);
            if (index !== -1) {
                this.form.telefones.splice(index, 1);
            }
        }
        ,
        addTelefone() {
            this.form.telefones.push({
                numero: '',
                proprietario: '',
                operadora: '',
                tipo: ''
            });

        },
        cnpjLoad() {
            if (this.form.cnpj.numero.replace(/[\D]/gi, '').length < 14) return;
            this.$cnpj.get(this.form.cnpj.numero.replace(/[\D]/gi, ''))
                .then(response => {
                    this.form.razaoSocial = response.data.nome;
                    this.form.nomeFantasia = response.data.fantasia;
                    this.form.email.email = response.data.email;
                    this.form.telefones[0].numero = response.data.telefone;
                })
                .catch(error => {
                    this.$notify.error({
                        title: 'Erro!',
                        message: error
                    });
                });
        }

    }
}

</script>
<style>
.el-input--suffix {
    width: 120px;
}
</style>