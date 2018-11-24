<template>
    <section>
        <el-row :gutter="15">
            <el-col :span="10">
                <el-card class="box-card" header="Vendas em Aberto">

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

                <el-card class="box-card" header="Interações em Vendas">
                    <el-table :data="filterInteracao()" style="width: 100%">
                        <el-table-column label="Tipo" width="60">
                            <template slot-scope="scope">
                                <icon v-if="scope.row.sentido == 'out'" name="caret-right"></icon>
                                <icon v-if="scope.row.sentido == 'in'" name="caret-left"></icon>
                                <icon v-if="scope.row.tipo == 'Visita'" name="user-tie"></icon>
                                <icon v-if="scope.row.tipo == 'Telefonema'" name="phone"></icon>
                                <icon v-if="scope.row.tipo == 'Email'" name="envelope"></icon>
                            </template>
                        </el-table-column>
                        <el-table-column label="Quando" width="160">
                            <template slot-scope="scope">
                                <icon name="calendar-alt" />{{ scope.row.data | moment('DD/MM/YYYY') }}
                            </template>
                        </el-table-column>
                        <el-table-column label="Empresa" width="160">
                            <template slot-scope="scope">
                                <el-popover trigger="hover" placement="top">
                                    <p>Razão Social: {{ scope.row.pessoaJuridica.razaoSocial }}</p>
                                    <div slot="reference">
                                        {{ scope.row.pessoaJuridica.nomeFantasia }}
                                    </div>
                                </el-popover>
                            </template>
                        </el-table-column>
                        <el-table-column label="Ação">
                            <template slot-scope="scope">
                                <el-button type="primary" size="mini" circle>
                                    <icon name="external-link-alt"></icon>
                                </el-button>
                            </template>
                        </el-table-column>
                    </el-table>

                </el-card>
            </el-col>
            <registrar-venda :visible.sync="showRegisterView" :vendaModel="currentData"></registrar-venda>
        </el-row>
        <el-row>
            <el-col :span="24">
                <el-card title="Feedback" header="Pendente Feedback">
                    
    <el-table :data="filterLackFeedback()" style="width: 100%">
        <el-table-column label="Tipo" width="60">
            <template slot-scope="scope">
                <icon v-if="scope.row.sentido == 'out'" name="caret-right"></icon>
                <icon v-if="scope.row.sentido == 'in'" name="caret-left"></icon>
                <icon v-if="scope.row.tipo == 'Visita'" name="user-tie"></icon>
                <icon v-if="scope.row.tipo == 'Telefonema'" name="phone"></icon>
                <icon v-if="scope.row.tipo == 'Email'" name="envelope"></icon>
            </template>
        </el-table-column>
        <el-table-column label="Quando" width="200">
            <template slot-scope="scope">
                <icon name="calendar-alt" />{{ scope.row.data | moment('DD/MM/YYYY') }} 
                <icon name="clock" />{{ scope.row.hora | moment('HH:MM') }}
            </template>
        </el-table-column>
        <el-table-column label="Empresa" width="320">
            <template slot-scope="scope">
                <el-popover trigger="hover" placement="top">
                    <p>Razão Social: {{ scope.row.pessoaJuridica.razaoSocial }}</p>
                    <div slot="reference">
                        {{ scope.row.pessoaJuridica.nomeFantasia }}
                    </div>
                </el-popover>
            </template>
        </el-table-column>
        <el-table-column label="Ação">
            <template slot-scope="scope">
                <el-button type="primary" size="mini" circle @click="showFeedback(scope.row)">
                    <icon name="external-link-alt"></icon>
                </el-button>
            </template>
        </el-table-column>
    </el-table>

                </el-card>
            </el-col>
            <feedback :visible.sync="feedbackModalVisible" type="venda" :data="feedbackData"/>
        </el-row>
    </section>
</template>
<script>
import RegistrarVenda from '../components/register/Venda.vue';
import Feedback from '../components/register/Feedback.vue';
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
            feedbackData: {},
            vendas: [],
            interacaosEmVendas: [],
            feedbackModalVisible: false,
        }
    },
    components: { RegistrarVenda, Feedback },
    methods: {
        showSaleRegister(data) {
            this.currentData = data;
            this.showRegisterView = true;
        },
        showFeedback(data){
            this.feedbackData = data;
            this.feedbackModalVisible = true;
        },
        filterLackFeedback() {
           console.log(this.filterInteracao());
           return this.filterInteracao().filter(interacao => !interacao.hasOwnProperty('feedback') || interacao.feedback == '');
        },
        filterInteracao() {
            return [].concat.apply([], this.vendas.map(
                venda => venda.interacaos.map(
                    interacao => Object.assign({pessoaJuridica: venda.pessoaJuridica},interacao)
                    )
                )
            );
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
<style scoped>
.el-card{
    margin-bottom: 15px;
}
    
</style>