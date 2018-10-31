<template>
    <el-card class="box-card">
        <div slot="header" class="clearfix">
            {{title}}
        </div>

        <el-input placeholder="Nome Fantasia" prefix-icon="el-icon-search" @change="findEmpresa()" v-model="search"></el-input>
        
        <el-table :data="tableData" style="width: 100%" empty-text="Nenhum resultado encontrado.">
            <el-table-column prop="cnpj" label="Cnpj" sortable width="150"></el-table-column>
            <el-table-column prop="razao_social" label="Razão Social" width="260"></el-table-column>
            <el-table-column prop="nome_fantasia" label="Nome Fantasia" width="140"></el-table-column>
            <el-table-column prop="telefones[0].numero" label="Telefones" width="130"></el-table-column>
            <el-table-column prop="enderecos[0].logradouro" label="Enderecos" width="260"></el-table-column>
            <el-table-column prop="email" label="E-Mail" width="100"></el-table-column>
            <el-table-column prop="ramo_atividade" label="Ramo de Atividade" width="150"></el-table-column>
            <el-table-column prop="inscricao_estadual," label="Inscrição Est." width="120"></el-table-column>
            <el-table-column prop="numero_funcionarios" label="Funcionarios" width="120"></el-table-column>
            <el-table-column prop="representante_legal.nome" label="Representante Legal" width="120"></el-table-column>
            <el-table-column fixed="right" label="Ação" width="90">
                <template slot-scope="scope">
                    <el-button size="mini" icon="el-icon-edit" @click="handleEdit(scope.row)" circle></el-button>
                    <el-button size="mini" icon="el-icon-delete" type="danger" @click="handleDelete(scope.row.id)" circle></el-button>
                </template>
            </el-table-column>
        </el-table>

        <hr/>

        <cadastrar-empresa :visible.sync="dialogFormVisible" :datamodel="dataModel"></cadastrar-empresa>

        <el-button id="add" type="success" icon="el-icon-plus" circle @click="handleCreate()"></el-button>

    </el-card>
</template>

<script>
import CadastrarEmpresa from '../components/register/Empresa.vue';
export default {
    data() {
        return {
            title: 'Empresas',
            tableData: [],
            dialogFormVisible: false,
            dataModel: null,
            search: ''
        }
    },
    methods: {
        filterTag(value, row) {
            return row.tag === value;
        },
        filterHandler(value, row, column) {
            const property = column['property'];
            return row[property] === value;
        },
        findAll() {
            this.$request.get('pj')
                .then(response => {
                    this.tableData = response.data;
                })
                .catch(error => {
                    console.log(error);
                    this.$notify.error({
                        title: 'Erro!',
                        message: 'Não foi possível carregar a lista de empresas'
                    })
                })
        },
        findEmpresa(){
            this.$request.get(`pj/${this.search}`)
            .then(response => {
                this.tableData = response.data;
            })
        },
        handleDelete(id) {
            this.$confirm('Você tem certeza que desja excluir esta empresa?')
                .then(_ => {
                    this.$request.delete(`pj/${id}`)
                        .then(response => {
                            this.$notify({
                                type: 'success',
                                title: 'Sucesso',
                                message: 'Item excuído'
                            })
                        })
                        .catch(error => {
                            console.log(error);
                            this.$notify.error({
                                title: 'Erro!',
                                message: 'Não foi possível excluir o item desejado'
                            });
                        });
                    done();
                })
                .catch(_ => { });
        },
        handleCreate(){
            this.dataModel = null;
            this.dialogFormVisible = true;
        },
        handleEdit(data){
            this.dataModel = {
                razaoSocial: data.razao_social,
                telefones: data.telefones,
                enderecos: data.enderecos,
                email: {
                    email: data.email,
                },
                grupos: data.grupos,
                nomeFantasia: data.nome_fantasia,
                inscricaoEstadual: {
                    numero: data.inscricao_estadual
                },
                cnpj: {
                    numero: data.cnpj
                },
                numeroFuncionarios: data.numero_funcionarios,
                representanteLegal: data.representante_legal,
                ramoAtividade: data.ramo_atividade
            };
            this.dialogFormVisible = true;
        }
    },
    mounted: function() {
        this.findAll();
    },
    components: { CadastrarEmpresa }
}
</script>

<style>
#add {
    position: fixed;
    bottom: 50px;
    right: 50px;
    z-index: 100;
}
</style>