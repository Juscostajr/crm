<template>
    <el-card class="box-card">
        <div slot="header" class="clearfix">
            {{title}}
        </div>

        <el-input placeholder="Nome" prefix-icon="el-icon-search" @change="find()" v-model="search"></el-input>

        <el-table :data="tableData" style="width: 100%" empty-text="Nenhum resultado encontrado.">
            <el-table-column prop="id" label="Id" sortable width="150"></el-table-column>
            <el-table-column prop="descricao" label="Nome" width="260"></el-table-column>
            <el-table-column fixed="right" label="Ação" width="90">
                <template slot-scope="scope">
                    <el-button size="mini" icon="el-icon-edit" @click="handleEdit(scope.row)" circle></el-button>
                    <el-button size="mini" icon="el-icon-delete" type="danger" @click="handleDelete(scope.row.id)" circle></el-button>
                </template>
            </el-table-column>
        </el-table>

        <hr/>

        <cadastrar-servico :visible.sync="dialogFormVisible" :datamodel="dataModel"></cadastrar-servico>

        <el-button id="add" type="success" icon="el-icon-plus" circle @click="handleCreate()"></el-button>

    </el-card>
</template>

<script>
import CadastrarServico from '../components/register/Servico.vue';
export default {
    data() {
        return {
            title: 'Servicos',
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
            this.$request.get('servico')
                .then(response => {
                    this.tableData = response.data;
                })
                .catch(error => {
                    console.log(error);
                    this.$notify.error({
                        title: 'Erro!',
                        message: 'Não foi possível carregar a lista de usuários'
                    })
                })
        },
        find() {
            this.$request.get(`servico/${this.search}`)
                .then(response => {
                    this.tableData = response.data;
                })
        },
        handleDelete(id) {
            this.$confirm('Você tem certeza que desja excluir esta servico?')
                .then(_ => {
                    this.$request.delete(`servico/${id}`)
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
        handleCreate() {
            this.dataModel = null;
            this.dialogFormVisible = true;
        },
        handleEdit(data) {
            this.dataModel = data;
            this.dialogFormVisible = true;
        }
    },
    mounted: function() {
        this.findAll();
    },
    components: { CadastrarServico }
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
