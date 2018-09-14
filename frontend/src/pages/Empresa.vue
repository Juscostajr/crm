<template>
    <el-card class="box-card">
        <div slot="header" class="clearfix">
            {{msg}}
        </div>

        <el-input
                placeholder="Type something"
                prefix-icon="el-icon-search">
        </el-input>

        <el-table :data="tableData" style="width: 100%" empty-text="Nenhum resultado encontrado.">
            <el-table-column prop="id" label="Id" sortable width="80"></el-table-column>
            <el-table-column prop="nome" label="Nome" width="180"></el-table-column>
            <el-table-column prop="telefones" label="Telefones" width="100"></el-table-column>
            <el-table-column prop="enderecos" label="Enderecos" width="100"></el-table-column>
            <el-table-column prop="email" label="E-Mail" width="100"></el-table-column>
            <el-table-column prop="razaoSocial" label="Razão Social" width="120"></el-table-column>
            <el-table-column prop="ramoAtividade" label="Ramo de Atividade" width="150"></el-table-column>
            <el-table-column prop="nomeFantasia" label="Nome Fantasia" width="140"></el-table-column>
            <el-table-column prop="inscricaoEstadual," label="Inscrição Est." width="120"></el-table-column>
            <el-table-column prop="enderecos" label="Enderecos" width="100"></el-table-column>
            <el-table-column prop="numeroFuncionarios" label="Funcionarios" width="120"></el-table-column>
            <el-table-column prop="representanteLegal" label="Representante Legal" width="120"></el-table-column>
        </el-table>

        <hr/>

        <el-row :gutter="20">
            <el-col :span="12" :offset="6">
                <el-pagination
                        :page-size="20"
                        :pager-count="11"
                        layout="prev, pager, next"
                        :total="1000">
                </el-pagination>
            </el-col>
        </el-row>

        <cadastrar-empresa :teste.sync="dialogFormVisible">

        </cadastrar-empresa>
        <el-button id="add" type="success" icon="el-icon-plus" circle @click="dialogFormVisible = true"></el-button>

    </el-card>
</template>
<script>
    import axios from 'axios';
    import CadastrarEmpresa from '../components/register/Empresa.vue';
    export default {
        data() {
            return {
                msg: 'Empresas',
                tableData: this.form,
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

            findAll(){
                var self = this;
                axios.get('http://localhost:8080/pj')
                        .then(function (response) {
                            self.tableData = response.data;
                        });
            },
        },
        mounted: function () {
            this.findAll();
        },
        components: {CadastrarEmpresa}
    }

</script>
<style>
    #add {
        position: fixed;
        bottom: 50px;
        right: 50px;
    }
</style>