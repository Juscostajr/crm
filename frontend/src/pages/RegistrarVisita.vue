<template>
    <el-card class="box-card">
        <div slot="header" class="clearfix">
            {{title}}
        </div>
        <el-form :model="form">
            <el-row>
                <el-col :span="24">
                    <el-form-item label="Empresa">
                        <br>
                        <el-row :gutter="15">
                            <el-col :span="22">
                                <remote-select data-source="pj" id="id" label="nome_fantasia" :model.sync="form.pj"></remote-select>
                            </el-col>
                            <el-col :span="2">
                                <el-button type="success" icon="el-icon-edit" @click="handleCreate()"></el-button>
                            </el-col>
                        </el-row>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="15">
                <el-col :span="12">
                    <el-form-item label="Número de Funcionáriros">
                        <el-input-number :min="0" :max="10000" v-model="form.numeroFuncionarios" auto-complete="off"></el-input-number>
                    </el-form-item>
                    <el-form-item label="Responsável">
                        <br>
                        <el-checkbox v-model="form.ausente">Ausente</el-checkbox>
                    </el-form-item>
                    <el-form-item label="Anotação">
                        <el-input type="textarea" v-model="form.anotacao[0]"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="12">
                    <el-form-item label="Interesses">
                        <br>
                        <el-checkbox v-for="servico in servicos" :key="servico.id" v-model="form.servico[servico.id]" :label="servico.descricao" border></el-checkbox>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row>
                <el-col :span="12">
                    <el-form-item label="Percepção de Satisfação">
                        <div class="block">
                            <el-rate 
                            v-model="form.feedback.satisfacao"
                             :texts="['Muito Insatisfeito', 'Insatisfeito', 'Regular', 'Satisfeito', 'Muito Satisfeito']"
                             show-text
                             :low-threshold="-2"
                             :high-threshold="2"
                            ></el-rate>
                        </div>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row>
                <el-col :span="24">
                    <el-button type="success" @click="save">Salvar</el-button>
                </el-col>
            </el-row>
        </el-form>
        <cadastrar-empresa :visible.sync="dialogFormVisible" :datamodel="dataModel"></cadastrar-empresa>

    </el-card>
</template>

<script>
import RemoteSelect from '../components/RemoteSelect.vue';
import CadastrarEmpresa from '../components/register/Empresa.vue';
export default {
    data() {
        return {
            title: 'Registrar Visita',
            dialogFormVisible: false,
            dataModel: null,
            form: {
                pj: {},
                ausente: false,
                numeroFuncionarios: 0,
                servico: [],
                anotacao: [],
                feedback: {
                    satisfacao: null,
                }
            },
            servicos: {
                id: '',
                descricao: ''
            }
        }
    },
    methods: {
        handleCreate() {
            this.dataModel = null;
            this.dialogFormVisible = true;
        },
        save() {
            console.log(this.form);
        }
    },
    mounted() {
        this.$request.get('servico')
            .then(response => {
                this.servicos = response.data;
            })
    },
    components: { RemoteSelect, CadastrarEmpresa }
}
</script>

<style>

</style>
