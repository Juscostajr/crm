<template>
    <el-dialog title="Registrar Filiação" :visible.sync="modal" width="80%" append-to-body>

        <el-form :model="formm">
            <el-row :gutter="10">
                <el-col :span="8">
                    <el-form-item label="CNPJ" :rules="{ required: true, message: 'Informe um cnpj válido', trigger:'blur' }">
                        <el-input v-model="formm.associado.pessoaJuridica.cnpj" auto-complete="off" v-inputmask="'99.999.999/9999-99'" @blur="cnpjLoad()"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="16">
                    <el-form-item label="Razão Social">
                        <el-input v-model="formm.associado.pessoaJuridica.razaoSocial" auto-complete="off"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="10">
                <el-col :span="8">
                    <el-form-item label="Nome Fantasia">
                        <el-input v-model="formm.associado.pessoaJuridica.nomeFantasia" auto-complete="off"></el-input>
                    </el-form-item>
                </el-col>

                <el-col :span="8">
                    <el-form-item label="Inscr. Estadual">
                        <el-input v-model="formm.associado.pessoaJuridica.inscricaoEstadual" auto-complete="off"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Ramo de Ativid.">
                        <remote-select data-source="ramo" id="id" label="descricao" :model.sync="formm.associado.pessoaJuridica.ramoAtividade"></remote-select>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="10">
                <el-col :span="10">
                    <el-form-item label="E-Mail">
                        <el-input type="email" v-model="formm.associado.pessoaJuridica.email" auto-complete="off"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="5">
                    <el-form-item label="Funcionários">
                        <el-input-number :min="0" :max="10000" v-model="formm.associado.pessoaJuridica.numeroFuncionarios" auto-complete="off"></el-input-number>
                    </el-form-item>
                </el-col>
                <el-col :span="9">
                    <el-form-item label="Representante Legal">
                        <remote-select data-source="pf" id="id" label="nome" :model.sync="formm.associado.pessoaJuridica.representanteLegal"></remote-select>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="10">
                <el-col :span="12">
                    <el-form-item label="Telefones">
                        <el-row>
                            <el-col :span="24">
                                <el-row v-for="(telefone, index) in formm.associado.pessoaJuridica.telefones" :gutter="10" :key="index">
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
                        <remote-select-multiple data-source="grupo" id="id" label="descricao" :model.sync="formm.associado.pessoaJuridica.grupos"></remote-select-multiple>
                    </el-form-item>
                    <el-form-item label="Enderecos">
                        <br>
                        <el-button type="success" icon="el-icon-plus" size="small" @click="innerVisible = true">
                            Adicionar
                        </el-button>
                        <endereco :isVisible.sync="innerVisible" :enderecos.sync="formm.associado.pessoaJuridica.enderecos"></endereco>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row>
                <el-col :span="12">
                    <el-form-item label="Data de Filiação">
                        <el-date-picker v-model="formm.associado.dataFiliacao" format="dd/MM/yyyy"></el-date-picker>
                    </el-form-item>
                    <el-form-item label="Status">
                        <el-radio v-model="formm.associado.statusAssociado" label="Ativo">Ativo</el-radio>
                        <el-radio v-model="formm.associado.statusAssociado" label="Inativo">Inativo</el-radio>
                    </el-form-item>
                    <el-form-item label="Valor da Mensalidade">
                        <el-input v-inputmask="
                                                'decimal', {
                                                'alias': 'decimal',
                                                'groupSeparator': '.',
                                                'autoGroup': true,
                                                'digits': 2,
                                                'radixPoint': ',',
                                                'digitsOptional': false,
                                                'allowMinus': false}" 
                                                @change="handleValorMensalidade">
                        </el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="12">
                    <el-form-item label="Adesões">
                        <el-checkbox v-for="servico in servicos" v-model="servicoSelected" :key="servico.id" :label="servico.descricao" border></el-checkbox>
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
    props: ['visible', 'pessoa'],
    data() {
        return {
            formLabelWidth: '120px',
            formm: this.model(),
            dialogFormVisible: true,
            showTelefone: false,
            innerVisible: false,
            formEndereco: {},
            telefoneTipos: [],
            operadoras: [],
            enderecos: [],
            modal: false,
            status: false,
            servicos: [],
            servicoSelected: []
        }
    },
    mounted() {
        this.$request.get('telefone')
            .then(response => {
                this.telefoneTipos = response.data;
            })
            .catch(function(error) {
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
        this.$request.get('servico')
            .then(response => {
                this.servicos = response.data;
            })
            .catch(error => {
                console.log(error);
                this.$notify.error({
                    title: 'Erro!',
                    message: 'Não foi possível carregar a lista de serviços'
                });
            });
    },
    watch: {
        modal() {
            this.$emit('update:visible', this.modal)
        },
        visible() {
            this.modal = this.visible;
            this.formm.associado.pessoaJuridica = this.pessoa;
            this.$request.get(`/associado/pessoa/${this.pessoa.id}`)
                .then(response => {
                    this.formm.associado.id = response.data.id;
                    this.formm.associado.dataFiliacao = response.data.dataFiliacao;
                    this.formm.associado.statusAssociado = response.data.statusAssociado;
                    this.formm.associado.dataFiliacao = response.data.dataFiliacao;
                    this.formm.associado.adesoes = response.data.adesoes;
                    this.servicoSelected = response.data.adesoes.map(adesao => {
                        return adesao.servico.descricao;
                    });
                    console.log(this.servicoSelected);
                    console.log(response.data);
                }).catch(error => console.log(error));
        },
        pessoa() {
            //if (this.pessoa == null) return this.clearForm();
            this.formm.associado.pessoaJuridica = this.pessoa;
            console.log(this.formm.associado.pessoaJuridica);
        }
    },
    components: { Endereco, RemoteSelect, RemoteSelectMultiple }
    ,
    methods: {
        save() {
            this.formm.associado.adesoes = this.getAdesaoUpdate(this.servicoSelected, this.servicos);
            console.log(this.formm.associado);
            this.$request.post('associado', this.formm.associado)
                .then(response => {
                    this.formm = this.model();
                    this.modal = false;
                    this.$notify({
                        title: 'Sucesso!',
                        message: 'Status do Associado Registrado',
                        type: 'success'
                    });
                })
                .catch(error => {
                    console.log(error);
                    this.$notify.error({
                        title: 'Erro!',
                        message: 'Não foi possível cadastrar a empresa, consulte a área de sistemas'
                    });
                });
                
        },
        handleValorMensalidade(value) {
            this.formm.associado.valorMensalidade = value;
        }
        ,
        model() {
            return {
                associado: {
                    pessoaJuridica: {
                        cnpj: '',
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
                        },
                        numeroFuncionarios: '',
                        representanteLegal: '',
                        ramoAtividade: {}
                    },
                    dataFiliacao: '',
                    statusAssociado: '',
                    valorMensalidade: '',
                    adesoes: []
                }
            }
        }
        ,
        removeTelefone(item) {
            var index = this.formm.associado.pessoaJuridica.telefones.indexOf(item);
            if (index !== -1) {
                this.formm.associado.pessoaJuridica.telefones.splice(index, 1);
            }
        }
        ,
        addTelefone() {
            this.formm.associado.pessoaJuridica.telefones.push({
                numero: '',
                proprietario: '',
                operadora: '',
                tipo: ''
            });

        },
        cnpjLoad() {
            if (this.formm.associado.pessoaJuridica.cnpj.numero.replace(/[\D]/gi, '').length < 14) return;
            this.$cnpj.get(this.formm.associado.pessoaJuridica.cnpj.numero.replace(/[\D]/gi, ''))
                .then(response => {
                    this.formm.associado.pessoaJuridica.razaoSocial = response.data.nome;
                    this.formm.associado.pessoaJuridica.nomeFantasia = response.data.fantasia;
                    this.formm.associado.pessoaJuridica.email.email = response.data.email;
                    this.formm.associado.pessoaJuridica.telefones[0].numero = response.data.telefone;
                })
                .catch(error => {
                    this.$notify.error({
                        title: 'Erro!',
                        message: error
                    });
                });
        },
        getAdesaoUpdate(selected, list) {
            return selected.map(servico => {
                return { id: list.find(val => val.descricao == servico).id }
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