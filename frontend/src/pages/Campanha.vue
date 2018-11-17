<template>
<div>
<el-row>
  <el-col :span="24">
      <el-card header="Campanhas">
          <el-table
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
  <el-button type="success" icon="el-icon-plus" @click="campanhaRegisterVisible = true">Nova Campanha</el-button>
  <campanha :visible.sync="campanhaRegisterVisible"></campanha>
      </el-card>
      <p v-if="currentRow === null">Selecione uma campanha</p>
        <el-tabs  v-if="currentRow !== null">
    <el-tab-pane label="Parâmetros" name="first">
        <el-row :gutter="15">
          <el-col :span="14">
              <el-card header="Checklists">
              <el-table :data="currentRow.perguntas" style="width: 100%">
    <el-table-column type="index"/>
    <el-table-column property="descricao" label="Inicio"/>
  </el-table>
  <el-button type="success" icon="el-icon-edit" @click="perguntasCampanhaVisible = true"></el-button>
  <el-button type="warning" @click="listaCampanhaVisible = true">Listar</el-button>
  <perguntas-campanha :visible.sync="perguntasCampanhaVisible" :data="this.currentRow"/>
  <lista-campanha :visible.sync="listaCampanhaVisible" :data="this.currentRow"/>
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
        
    </el-tab-pane>
    <el-tab-pane label="Resultados" name="second">Resultados</el-tab-pane>
  </el-tabs>
  </el-col>
</el-row>

</div>

    
</template>
<script>
import Campanha from "../components/register/Campanha.vue";
import PerguntasCampanha from "../components/register/PerguntasCampanha.vue";
import ListaCampanha from "../components/register/ListaCampanha.vue";
export default {
  data() {
    return {
      title: "Campanha",
      currentRow: null,
      campanhaRegisterVisible: false,
      perguntasCampanhaVisible: false,
      listaCampanhaVisible: false,
      campanhas: []
    };
  },
  methods: {
    setCurrent(row) {
      this.$refs.singleTable.setCurrentRow(row);
    },
    handleCurrentChange(val) {
      this.currentRow = val;
    }
  },
  components: { Campanha, PerguntasCampanha, ListaCampanha },
  mounted() {
    this.$request.get("campanha").then(response => {
      this.campanhas = response.data;
    });

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
</style>


