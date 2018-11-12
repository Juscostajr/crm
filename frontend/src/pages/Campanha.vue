<template>
<div>
<el-row>
  <el-col :span="24">
      <el-card header="Campanhas">
          <el-table
    ref="singleTable"
    :data="tableData"
    highlight-current-row
    @current-change="handleCurrentChange"
    style="width: 100%">
    <el-table-column
      type="index"
      width="50">
    </el-table-column>
    <el-table-column
      property="date"
      label="Inicio"
      width="120">
    </el-table-column>
    <el-table-column
      property="name"
      label="Término"
      width="120">
    </el-table-column>
    <el-table-column
      property="address"
      label="Nome">
    </el-table-column>
  </el-table>
  <el-button type="success" icon="el-icon-plus" @click="campanhaRegisterVisible = true">Nova Campanha</el-button>
  <campanha :visible.sync="campanhaRegisterVisible"></campanha>
      </el-card>
      <p v-if="currentRow === null">Selecione uma campanha</p>
        <el-tabs v-model="activeName" v-if="currentRow !== null">
    <el-tab-pane label="Parâmetros" name="first">
        <el-row :gutter="15">
          <el-col :span="14">
              <el-card header="Checklists">
              <el-table
    ref="singleTable"
    :data="tableData"
    highlight-current-row
    @current-change="handleCurrentChange"
    style="width: 100%">
    <el-table-column
      type="index"
      width="50">
    </el-table-column>
    <el-table-column
      property="date"
      label="Inicio"
      width="120">
    </el-table-column>
    <el-table-column
      property="name"
      label="Término"
      width="120">
    </el-table-column>
    <el-table-column
      property="address"
      label="Nome">
    </el-table-column>
  </el-table>
  <el-button type="success" icon="el-icon-edit"></el-button>
  <el-button type="warning">Listar</el-button>
  </el-card>
          </el-col>
          <el-col :span="6">
              <el-card :body-style="{'background-color': '#409EFF', height: '345px'}" class="data-campanha">
                  <h5>Target</h5>
                  <h1><icon name="bullseye"/></h1>
                  <hr/>
                  <h5>Serviço</h5>
                  <h3>Certificado Digital</h3>
                  <br/>
                  <hr/>
                  <h5>Grupo</h5>
                  <h3>Contadores</h3>
              </el-card>
          </el-col>
          <el-col :span="4">
              <el-row>
                <el-col :span="24"><el-card :body-style="{'background-color': '#67c23a'}" class="data-campanha">
                    <h5>Inicio</h5>
                    <h1>24</h1>
                    <h3>Out 2018</h3>
                    </el-card></el-col>
              </el-row>
              <el-row>
                <el-col :span="24">
                    <el-card :body-style="{'background-color': '#f56c6c'}" class="data-campanha">
                        <h5>Termino</h5>
                        <h1>22</h1>
                        <h3>Nov 2018</h3>
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
import Campanha from '../components/register/Campanha.vue';
export default {
  data() {
    return {
      title: "Campanha",
      tableData: [
        {
          date: "2016-05-03",
          name: "Tom",
          address: "No. 189, Grove St, Los Angeles"
        },
        {
          date: "2016-05-02",
          name: "Tom",
          address: "No. 189, Grove St, Los Angeles"
        },
        {
          date: "2016-05-04",
          name: "Tom",
          address: "No. 189, Grove St, Los Angeles"
        },
        {
          date: "2016-05-01",
          name: "Tom",
          address: "No. 189, Grove St, Los Angeles"
        }
      ],
      currentRow: null,
      campanhaRegisterVisible: false,
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
  components: {Campanha}
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


