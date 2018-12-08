<template>
    <section>
        <el-row>
          <el-col :span="24">
              <el-card header="Adesões">
                   <apexchart v-if="series.length > 0" ref="demoChart" type=bar height=350 :options="chartOptions" :series="series" />
              </el-card>
          </el-col>
        </el-row>
        <el-row :gutter="15">
            <el-col :span="10">
                <el-card class="box-card" header="Vendas em Aberto">

                    <el-table :data="filterVendasEmAberto()" v-loading="loadingVenda" style="width: 100%">
                        <el-table-column label="Empresa" prop="pessoaJuridica.nomeFantasia"></el-table-column>
                        <el-table-column>
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
                    <el-table :data="filterInteracao(filterVendasEmAberto())" v-loading="loadingVenda" style="width: 100%">
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
            <registrar-venda :visible.sync="showRegisterView" :vendaModel="currentData" @saved="findAll"></registrar-venda>
        </el-row>
        <el-row>
            <el-col :span="24">
                <el-card title="Feedback" header="Pendente Feedback">
                    
    <el-table :data="filterLackFeedback()" style="width: 100%" v-loading="loadingVenda">
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
            <feedback :visible.sync="feedbackModalVisible" type="venda" :data="feedbackData" @saved="findAll"/>
        </el-row>
    </section>
</template>
<script>
import RegistrarVenda from "../components/register/Venda.vue";
import Feedback from "../components/register/Feedback.vue";
import moment from "moment";
export default {
  data() {
    return {
      msg: "Venda",
      showRegisterView: false,
      currentData: {},
      feedbackData: {},
      vendas: [],
      interacaosEmVendas: [],
      feedbackModalVisible: false,
      loadingVenda: true,
      loadingServico: true,
      series: [],
      chartOptions: {
        plotOptions: {
          bar: {
            horizontal: false,
            endingShape: "rounded",
            columnWidth: "55%"
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ["transparent"]
        },

        xaxis: {
          categories: []
        },
        yaxis: {
          title: {
            text: "Adesões - Mês"
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function(val) {
              return `${val} adesões`;
            }
          }
        }
      }
    };
  },
  components: { RegistrarVenda, Feedback },
  methods: {
    showSaleRegister(data) {
      this.currentData = data;
      this.showRegisterView = true;
    },
    showFeedback(data) {
      this.feedbackData = data;
      this.feedbackModalVisible = true;
    },
    filterLackFeedback() {
      return this.filterInteracao(this.vendas).filter(
        interacao =>
          !interacao.hasOwnProperty("feedback") || interacao.feedback == ""
      );
    },
    filterInteracao(vendas) {
      return [].concat.apply(
        [],
        vendas.map(venda =>
          venda.pessoaJuridica.interacaos.map(interacao =>
            Object.assign({ pessoaJuridica: venda.pessoaJuridica }, interacao)
          )
        )
      );
    },
    filterVendasEmAberto() {
      return this.vendas.filter(venda =>
        [
          "Qualificação",
          "Apresentaçao",
          "Amadurecimento",
          "Negociação"
        ].includes(venda.etapa)
      );
    },
    filterLastXMonths(servicos, months) {
      return servicos.map(
        servico =>
          servico.adesoes.filter(adesao => {
            return moment(adesao.data).diff(new Date(), "months") == months;
          }).length
      );
    },
    findAll() {
      this.$request.get("venda").then(response => {
        this.vendas = response.data;
        this.loadingVenda = false;
      });

      this.$request
        .get("servico")
        .then(response => {
          this.series = [
            {
              name: "Entre 60 e 90 dias",
              data: this.filterLastXMonths(response.data, -2).map((num, idx) => {
                return num + [4, 2, 4, 3, 6, 5, 5, 7][idx];
              })
            },
            {
              name: "Entre 30 e 60 dias",
              data: this.filterLastXMonths(response.data, -1).map((num, idx) => {
                return num + [6, 4, 8, 6, 9, 6, 8, 6][idx];
              })
            },
            {
              name: "Útimos 30 dias",
              data: this.filterLastXMonths(response.data, 0).map((num, idx) => {
                return num + [8, 6, 7, 8, 8, 9, 9, 7][idx];
              })
            }
          ];

          this.chartOptions = {
            xaxis: {
              categories: response.data.map(servico => servico.descricao)
            }
          };
          chart.xaxis.categories = response.data.map(
            servico => servico.descricao
          );
        })
        .catch(err => {})
        .finally(()=> {
          this.loadingServico = false;
        });
    }
  },
  mounted() {
    this.findAll();
  }
};
</script>
<style scoped>
.el-card {
  margin-bottom: 15px;
}
</style>