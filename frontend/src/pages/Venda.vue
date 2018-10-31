<template>
    <el-row :gutter="15">
        <el-col :span="10">
            <el-card class="box-card">
                <div slot="header" class="clearfix">
                    <span>Vendas em Aberto</span>
                    <el-button style="float: right; padding: 3px 0" type="text">Operation button</el-button>
                </div>

                <el-table :data="vendas" style="width: 100%">
                    <el-table-column label="Empresa" width="220" prop="pessoaJuridica.nomeFantasia"></el-table-column>
                    <el-table-column width="180">
                        <template slot-scope="scope">
                            <el-popover trigger="hover" placement="top">
                                <p>Name: {{ scope.row.pessoaJuridica.razaoSocial }}</p>
                                <p>CNPJ: {{ scope.row.pessoaJuridica.cnpj }}</p>
                                <div slot="reference" class="name-wrapper">
                                    <el-tag size="medium">{{ scope.row.etapa }}</el-tag>
                                </div>
                            </el-popover>
                        </template>
                    </el-table-column>
                    <el-table-column width="40">
                        <template slot-scope="scope">
                            <el-button size="mini" type="primary" @click="showSaleRegister(scope.row)" icon="el-icon-view" circle></el-button>
                        </template>
                    </el-table-column>
                </el-table>
            </el-card>
        </el-col>
        <el-col :span="14">

            <el-card class="box-card">
                <div slot="header" class="clearfix">
                    <span>Interações em Vendas</span>
                    <el-button style="float: right; padding: 3px 0" type="text">Operation button</el-button>
                </div>

                <el-table :data="tableData2" style="width: 100%">
                    <el-table-column label="Tipo" width="60">
                        <template slot-scope="scope">
                            <icon v-if="scope.row.sentido == 'out'" name="caret-right"></icon>
                            <icon v-if="scope.row.sentido == 'in'" name="caret-left"></icon>
                            <icon v-if="scope.row.tipo == 'visita'" name="user-tie"></icon>
                            <icon v-if="scope.row.tipo == 'telefone'" name="phone"></icon>
                            <icon v-if="scope.row.tipo == 'email'" name="envelope"></icon>
                        </template>
                    </el-table-column>
                    <el-table-column label="Quando" width="160">
                        <template slot-scope="scope">
                            <icon name="calendar-alt" />{{ scope.row.date }}</template>
                    </el-table-column>
                    <el-table-column label="Empresa" width="160">
                        <template slot-scope="scope">
                            <el-popover trigger="hover" placement="top">
                                <p>Name: {{ scope.row.name }}</p>
                                <p>Addr: {{ scope.row.address }}</p>
                                <div slot="reference" class="name-wrapper">
                                    <el-tag size="medium">{{ scope.row.name }}</el-tag>
                                </div>
                            </el-popover>
                        </template>
                    </el-table-column>
                    <el-table-column label="Ação">
                        <template slot-scope="scope">
                            <el-button type="success" size="mini" circle>
                                <icon name="user-tie"></icon>
                            </el-button>
                            <el-button type="success" size="mini" circle>
                                <icon name="phone"></icon>
                            </el-button>
                            <el-button type="success" size="mini" circle>
                                <icon name="envelope"></icon>
                            </el-button>
                            <el-button type="primary" size="mini" circle>
                                <icon name="external-link-alt"></icon>
                            </el-button>
                        </template>
                    </el-table-column>
                </el-table>

            </el-card>
        </el-col>

        </el-col>
        <el-col :span="8"></el-col>
        <registrar-venda :visible.sync="showRegisterView" :datamodel="currentData"></registrar-venda>
    </el-row>
</template>
<script>
import RegistrarVenda from '../components/register/Venda.vue';
export default {
    data() {
        return {
            msg: 'Venda',
            tableData: [{
                date: '2016-05-03',
                name: 'Tom',
                address: 'No. 189, Grove St, Los Angeles'
            }, {
                date: '2016-05-02',
                name: 'Tom',
                address: 'No. 189, Grove St, Los Angeles'
            }, {
                date: '2016-05-04',
                name: 'Tom',
                address: 'No. 189, Grove St, Los Angeles'
            }, {
                date: '2016-05-01',
                name: 'Tom',
                address: 'No. 189, Grove St, Los Angeles'
            }],
            tableData2: [{
                tipo: 'telefone',
                sentido: 'in',
                date: '2016-05-03',
                name: 'Tom'
            }, {
                tipo: 'visita',
                sentido: 'in',
                date: '2016-05-02',
                name: 'Tom'
            }, {
                tipo: 'email',
                sentido: 'in',
                date: '2016-05-04',
                name: 'Tom'
            }, {
                tipo: 'telefone',
                sentido: 'out',
                date: '2016-05-01',
                name: 'Tom'
            }],
            showRegisterView: false,
            currentData: {},
            vendas: [],
        }
    },
    components: { RegistrarVenda },
    methods: {
        showSaleRegister(data) {
            this.currentData = data;
            this.showRegisterView = true;
        }
    },
    mounted() {
        this.$request.get('venda')
            .then(response => {
                this.vendas = response.data;
            })
    },

}
</script>
<style></style>