<template>
<div>
<el-row>
  <el-col :span="24">
      <el-card header="Campanhas">
          <el-table
    v-loading="loading" 
    ref="singleTable"
    :data="campanhas"
    highlight-current-row
    @current-change="handleCurrentChange"
    style="width: 100%">
    <el-table-column type="index" width="50"/>
    <el-table-column property="nome" label="Nome"/>
    <el-table-column property="descricao" label="Descrição" />
    <el-table-column label="Inicio">
      <template slot-scope="scope">
        {{ scope.row.inicio | moment('DD/MM/YYYY') }}
      </template>
    </el-table-column>
    <el-table-column label="Termino">
      <template slot-scope="scope">
        {{scope.row.final | moment('DD/MM/YYYY')}}
      </template>
    </el-table-column>
  </el-table>
  <el-button type="success" icon="el-icon-plus" @click="campanhaRegisterVisible = true" class="btn-nova-campanha">Nova Campanha</el-button>
  <campanha :visible.sync="campanhaRegisterVisible" @saved="findAll"></campanha>
      </el-card>
        <el-row  v-if="currentRow !== null" :gutter="15">
          <el-col :span="14">
            <el-card header="Resultados" v-if="new Date(this.currentRow.inicio).getTime() <= new Date().getTime()">
              <apexchart type=bar height=350 :options="chartOptions" :series="series" />
          </el-card>
              <el-card header="Checklists" v-if="new Date(this.currentRow.inicio).getTime() > new Date().getTime()">
              <el-table :data="currentRow.perguntas" style="width: 100%">
    <el-table-column type="index"/>
    <el-table-column property="descricao" label="Inicio"/>
  </el-table>
  <el-button type="success" icon="el-icon-edit" @click="perguntasCampanhaVisible = true"></el-button>
  <el-button type="warning" @click="listaCampanhaVisible = true">Listar</el-button>
  <perguntas-campanha :visible.sync="perguntasCampanhaVisible" :data="this.currentRow" @saved="findAll"/>
  <lista-campanha :visible.sync="listaCampanhaVisible" :data="this.currentRow" @saved="findAll"/>
  </el-card>
          </el-col>
          <el-col :span="6">
              <el-card :body-style="{'background-color': '#409EFF', height: '345px'}" class="data-campanha">
                  <h5>Target</h5>
                  <h1><icon name="bullseye"/></h1>
                  <hr/>
                  <h5>Serviço</h5>
                  <h3>{{this.currentRow.servico.descricao}}</h3>
                  <br/>
                  <hr/>
                  <h5>Grupo</h5>
                  <h3>{{this.currentRow.target.descricao}}</h3>
              </el-card>
          </el-col>
          <el-col :span="4">
              <el-row>
                <el-col :span="24"><el-card :body-style="{'background-color': '#67c23a'}" class="data-campanha">
                    <h5>Inicio</h5>
                    <h1>{{this.currentRow.inicio | moment('DD')}}</h1>
                    <h3>{{this.currentRow.inicio | moment('MMM YYYY')}}</h3>
                    </el-card></el-col>
              </el-row>
              <el-row>
                <el-col :span="24">
                    <el-card :body-style="{'background-color': '#f56c6c'}" class="data-campanha">
                        <h5>Termino</h5>
                    <h1>{{this.currentRow.final | moment('DD')}}</h1>
                    <h3>{{this.currentRow.final | moment('MMM YYYY')}}</h3>
                    </el-card>
                </el-col>
              </el-row>
              
          </el-col>
        </el-row>

  </el-col>
</el-row>

</div>

    
</template>
<script>
import Campanha from "../components/register/Campanha.vue";
import PerguntasCampanha from "../components/register/PerguntasCampanha.vue";
import ListaCampanha from "../components/register/ListaCampanha.vue";
import moment from "moment";
export default {
  data() {
    return {
      title: "Campanha",
      loading: true,
      currentRow: null,
      campanhaRegisterVisible: false,
      perguntasCampanhaVisible: false,
      listaCampanhaVisible: false,
      campanhas: [],
      adesoes: [],
      series: [
        {
          name: "",
          data: []
        }
      ],
      chartOptions: {
        chart: {
          height: 350,
          type: "bar"
        },
        plotOptions: {
          bar: {
            dataLabels: {
              position: "top" // top, center, bottom
            }
          }
        },
        dataLabels: {
          enabled: true,
          formatter: function(val) {
            return `${val} adesões`;
          },
          offsetY: -20,
          style: {
            fontSize: "12px",
            colors: ["#304758"]
          }
        },

        xaxis: {
          categories: [],
          position: "top",
          labels: {
            offsetY: -18
          },
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false
          },
          crosshairs: {
            fill: {
              type: "gradient",
              gradient: {
                colorFrom: "#D8E3F0",
                colorTo: "#BED1E6",
                stops: [0, 100],
                opacityFrom: 0.4,
                opacityTo: 0.5
              }
            }
          },
          tooltip: {
            enabled: true,
            offsetY: -35
          }
        },
        fill: {
          gradient: {
            enabled: false,
            shade: "light",
            type: "horizontal",
            shadeIntensity: 0.25,
            gradientToColors: undefined,
            inverseColors: true,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [50, 0, 100, 100]
          }
        },
        yaxis: {
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false
          },
          labels: {
            show: false,
            formatter: function(val) {
              return val;
            }
          }
        },
        title: {
          text: `Adesões - Target - Período`,
          floating: true,
          offsetY: 320,
          align: "center",
          style: {
            color: "#444"
          }
        }
      }
    };
  },
  methods: {
    setCurrent(row) {
      this.$refs.singleTable.setCurrentRow(row);
    },
    handleCurrentChange(val) {
      this.currentRow = val;
      let target = this.filterGrupo(this.filterTarget(this.adesoes));
  
      const dtInicioAnterior = moment(val.inicio).subtract(
        moment(val.final).diff(moment(val.inicio), "days"),
        "days"
      );
      const dtFinalAnterior = moment(val.inicio).subtract(1, "days");
    
      this.series = [
        {
          name: "Adesões",
          data: [
            this.filterDate(target, val.inicio, val.final).length + 2,
            this.filterDate(target, dtInicioAnterior, dtFinalAnterior).length + 4
          ]
        }
      ];

      this.chartOptions.xaxis.categories = [
        `${dtInicioAnterior.format("DD/MMM")} - ${dtFinalAnterior.format(
          "DD/MMM"
        )}`,
        `${moment(val.inicio).format("DD/MMM")} - ${moment(val.final).format("DD/MMM")}`
      ];

      
    },
    findAll() {
      this.$request.get("campanha").then(response => {
        this.campanhas = response.data;
      })
      this.findAdesoes();
    },
    findAdesoes() {
      this.$request.get("adesao").then(response => {
        this.adesoes = response.data;
        this.loading = false
      });
    },
    filterTarget(adesoes) {
      return adesoes.filter(
        adesao => adesao.servico.id == this.currentRow.servico.id
      );
    },
    filterGrupo(adesoes) {
      return adesoes.filter(adesao =>
        adesao.associado.pessoaJuridica.grupos.some(
          grupo => grupo.id == this.currentRow.target.id
        )
      );
    },
    filterDate(adesoes, start, end) {
      return adesoes.filter(
        adesao =>
          moment(adesao.data).diff(moment(start)) >= 0 &&
          moment(adesao.data).diff(moment(end)) <= 0
      );
    }
  },
  components: { Campanha, PerguntasCampanha, ListaCampanha },
  mounted() {
    this.findAll();
    this.$moment.updateLocale("en", {
      monthsShort: [
        "Jan",
        "Fev",
        "Mar",
        "Abr",
        "Mai",
        "Jun",
        "Jul",
        "Ago",
        "Set",
        "Out",
        "Nov",
        "Dez"
      ]
    });
  }
};
</script>
<style scoped>
.data-campanha {
  color: white;
  text-align: center;
}
.data-campanha h1 {
  font-size: 4em;
  margin: 0;
  line-height: 0.8em;
}
.data-campanha h3 {
  line-height: 0.2em;
}
.el-card {
  margin-bottom: 15px;
}
.btn-nova-campanha {
  float: right;
  margin: 15px 0;
}
</style>


