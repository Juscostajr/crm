<template>
    <el-card class="box-card">
        <div slot="header" class="clearfix">
            {{msg}}
        </div>

        <el-input placeholder="Type something" prefix-icon="el-icon-search">
        </el-input>

        <el-table :data="tableData" style="width: 100%" empty-text="Nenhum resultado encontrado.">
            <el-table-column prop="nome" label="Nome" width="130"></el-table-column>
            <el-table-column prop="cpf" label="Cpf" width="130"></el-table-column>
            <el-table-column prop="dtNascimento" label="Data de Nascimento" width="130"></el-table-column>
            <el-table-column prop="telefones[0].numero" label="Telefones" width="130"></el-table-column>
            <el-table-column prop="enderecos[0].logradouro" label="Enderecos" width="260"></el-table-column>
            <el-table-column prop="email" label="E-Mail" width="100"></el-table-column>
            <el-table-column fixed="right" label="Ação" width="90">
                <template slot-scope="scope">
                    <el-button size="mini" icon="el-icon-edit" @click="handleEdit(scope.$index, scope.row)" circle></el-button>
                    <el-button size="mini" icon="el-icon-delete" type="danger" @click="handleDelete(scope.$index, scope.row)" circle></el-button>
                </template>
            </el-table-column>

        </el-table>

        <hr/>

        <el-row :gutter="20">
            <el-col :span="12" :offset="6">
                <el-pagination :page-size="20" :pager-count="11" layout="prev, pager, next" :total="1000">
                </el-pagination>
            </el-col>
        </el-row>

        <pessoa-fisica :teste.sync="dialogFormVisible">

        </pessoa-fisica>
        <el-button id="add" type="success" icon="el-icon-plus" circle @click="dialogFormVisible = true"></el-button>

    </el-card>
</template>
<script>
import PessoaFisica from '../components/register/PessoaFisica.vue';
export default {
    data() {
        return {
            msg: 'Pessoa Física',
            tableData: [],
            dialogFormVisible: false,

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
            this.$request.get('pf')
                .then(response => {
                    this.tableData = response.data;
                })
                .catch(error => {
                    console.log(error);
                    this.$notify.error({
                        title: 'Erro!',
                        message: 'Não foi possível carregar a lista de pessoas'
                    })
                })
        },
    },
    mounted: function() {
        this.findAll();

    },
    components: { PessoaFisica }
}

</script>
<style>
#add {
    position: fixed;
    bottom: 50px;
    right: 50px;
}
</style>