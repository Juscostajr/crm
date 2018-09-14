<template>
    <el-dialog title="Cadastrar Empresa" :visible.sync="teste" width="80%">

        <el-form :model="form">
            <el-row :gutter="10">
                <el-col :span="8">
                    <el-form-item label="CNPJ">
                        <el-input v-model="form.cnpj" auto-complete="off" v-inputmask="'99.999.999/9999-99'" @blur="cnpjLoad()"></el-input>
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
                        <el-input v-model="form.inscricaoEstadual" auto-complete="off"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Ramo de Ativid.">
                        <el-input v-model="form.ramoAtividade" auto-complete="off"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="10">
                <el-col :span="10">
                    <el-form-item label="E-Mail">
                        <el-input type="email" v-model="form.email" auto-complete="off"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="5">
                    <el-form-item label="Funcionários">
                        <el-input-number :min="0" :max="10000" v-model="form.numeroFuncionarios"
                                         auto-complete="off"></el-input-number>
                    </el-form-item>
                </el-col>
                <el-col :span="9">
                    <el-form-item label="Representante Legal">
                        <el-input v-model="form.representanteLegal" auto-complete="off"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="10">
                <el-col :span="12">
                    <el-form-item label="Telefones">
                        <el-row>
                            <el-col :span="24">
                                <el-row v-for="(telefone, index) in form.telefones" :gutter="10">
                                    <el-col :span="18">
                                        <el-input v-model="telefone.numero" auto-complete="off" v-inputmask="'(99) 9999[9]-9999'">
                                            <el-select v-model="telefone.tipo" slot="prepend" placeholder="Tipo">
                                                <el-option v-for="tipo in telefoneTipos" :label="tipo | capitalize"
                                                           :value="tipo"></el-option>
                                            </el-select>

                                            <el-select v-model="telefone.operadora" slot="append"
                                                       placeholder="Operadora">
                                                <el-option v-for="operadora in operadoras" :label="operadora.nome"
                                                           :value="operadora.id"></el-option>
                                            </el-select>
                                        </el-input>
                                    </el-col>
                                    <el-col :span="6">
                                        <el-button-group>
                                            <el-button type="success" icon="el-icon-plus"
                                                       @click="addTelefone"></el-button>
                                            <el-button type="danger" icon="el-icon-delete" v-if="index > 0"
                                                       @click.prevent="removeTelefone(telefone)"></el-button>
                                        </el-button-group>
                                    </el-col>
                                </el-row>
                            </el-col>
                        </el-row>
                    </el-form-item>
                </el-col>
                <el-col :span="12">
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
                <el-button @click="teste = false">Cancelar</el-button>
                <el-button type="primary" @click="save">Salvar</el-button>
            </span>
    </el-dialog>

</template>
<script>
    import axios from 'axios';
    import Endereco from './Endereco.vue';
    export default {
        props: ['teste'],
        data () {
            return {
                formLabelWidth: '120px',
                form: {
                    nome: '',
                    telefones: [{
                        numero: '',
                        proprietario: '',
                        operadora: '',
                        tipo: ''
                    }],
                    enderecos: [],
                    email: '',
                    grupos: [{
                        tipo: '',
                        descricao: '',
                        membros: ''
                    }],
                    nomeFantasia: '',
                    inscricaoEstadual: '',
                    cnpj: '',
                    numeroFuncionarios: '',
                    representanteLegal: ''
                },
                dialogFormVisible: true,
                showTelefone: false,
                innerVisible: false,
                formEndereco: {},
                telefoneTipos: [],
                operadoras: [],
                enderecos: []

            }
        },
        mounted (){
            this.$request.get('telefone')
                .then(response => {
                    this.telefoneTipos = response.data;
                })
                .catch(function (error) {
                    this.$notify.error({
                        title: 'Erro!',
                        message: error
                    });
                });
            this.$request.get('operadora')
                .then(response => {
                    this.operadoras = response.data;
                })
                .catch(error => {
                    this.$notify.error({
                        title: 'Erro!',
                        message: error
                    });
                });
        },
        watch: {
            teste()
            {
                this.$emit('update:teste', this.teste)
            }
        }
        ,
        components: {Endereco}
        ,
        methods: {
            save()
            {
                this.$request.post('pj', this.form)
                    .then(response => {
                        this.findAll();
                        this.clearForm();
                        this.dialogFormVisible = false;
                        this.$notify({
                            title: 'Sucesso!',
                            message: 'Empresa salva corretamente',
                            type: 'success'
                        });
                    })
                    .catch(error => {
                        this.$notify.error({
                            title: 'Erro!',
                            message: error
                        });
                    });

            }
            ,
            clearForm()
            {
                this.form = {};
            }
            ,
            removeTelefone(item)
            {
                var index = this.form.telefones.indexOf(item);
                if (index !== -1) {
                    this.form.telefones.splice(index, 1);
                }
            }
            ,
            addTelefone()
            {
                this.form.telefones.push({
                    numero: '',
                    proprietario: '',
                    operadora: '',
                    tipo: ''
                });

            },
            cnpjLoad()
            {
                if (this.form.cnpj.replace(/[\D]/gi, '').length < 14) return;
                this.$cnpj.get(this.form.cnpj.replace(/[\D]/gi, ''))
                    .then(response => {
                        this.form.razaoSocial = response.data.nome;
                        this.form.nomeFantasia = response.data.fantasia;
                        this.form.email = response.data.email;
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