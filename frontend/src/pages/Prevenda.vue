<template>
    <div>
        <h2>{{msg}}</h2>
        <el-card class="box-card">
            <div slot="header" class="clearfix">
                Cobertura
            </div>
                
                <mapa :coordenadas="coordenadas" type="heatmap"></mapa>
                
        </el-card>
        <el-row :gutter="15">
          <el-col :span="12">
              <el-card header="Empresas não associadas">
                  <el-table :data="naoAssociados" v-loading="loading">
                    <el-table-column label="Bairro" prop="bairro"/>
                    <el-table-column label="Logradouro" prop="logradouro"/>
                    <el-table-column label="Número" prop="nrImovel"/>
                    <el-table-column label="Empresa" prop="nomeFantasia"/>
                  </el-table>
              </el-card>
          </el-col>
          <el-col :span="12">
              <el-card header="Relatório">
                  <label>Bairro</label>
                      <el-select v-model="bairro" placeholder="">
                    <el-option v-for="(item, index) in bairros" :key="index" :value="item"/>
                  </el-select>
                    <label>Logradouro</label>
                      <el-select v-model="logradouro" placeholder="">
                    <el-option v-for="(item, index) in logradouros" :key="index" :value="item"/>
                  </el-select>
                        <div class="bottom clearfix">
          <el-button type="default" icon="el-icon-printer" @click="renderReport">Gerar Relatório</el-button>
        </div>
              </el-card>
          </el-col>
        </el-row>
    </div>
</template>
<script>
import jsPDF from "jspdf";
require("jspdf-autotable");
import Mapa from "../components/Mapa.vue";
export default {
  data() {
    return {
      msg: "Pré-Venda",
      coordenadas: [],
      naoAssociados: [],
      bairro: "",
      logradouro: "",
      bairros: [],
      logradouros: [],
      loading: true,
    };
  },
  components: { Mapa },
  methods: {
    filterUnique(data, field) {
      return data
        .map(empresa => empresa[field])
        .filter((value, index, self) => {
          return self.indexOf(value) === index;
        });
    },
    filterReport() {
      if (this.logradouro != "") {
        return this.naoAssociados.filter(
          obj => obj.logradouro == this.logradouro
        );
      }

      if (this.bairro != "") {
        return this.naoAssociados.filter(obj => obj.bairro == this.bairro);
      }

      return this.naoAssociados;
    },
    renderReport() {
      var columns = [
        { title: "Empresa", dataKey: "nomeFantasia" },
        { title: "Bairro", dataKey: "bairro" },
        { title: "Logradouro", dataKey: "logradouro" },
        { title: "Número", dataKey: "nrImovel" }
      ];
      var rows = this.filterReport();

      // Only pt supported (not mm or in)
      var doc = new jsPDF("p", "pt");
      doc.autoTable(columns, rows, {
        margin: { top: 80 },
        addPageContent: function(data) {
          doc.text("(Logo) Nome da Empresa", 40, 30);
          doc.setFontSize(12);
          doc.text("Guia para visitação", 40, 50);
        }
      });
      doc.save("report.pdf");
    },
    findAll() {
      this.$request.get("naoassociado").then(response => {
        this.naoAssociados = response.data;
        this.bairros = this.filterUnique(response.data, "bairro");
        this.logradouros = this.filterUnique(response.data, "logradouro");
        this.coordenadas = response.data.map(obj => {
          return {
            latitude: parseFloat(obj.latitude),
            longitude: parseFloat(obj.longitude)
          };
        });
      })
      .finally(()=>{
          this.loading = false;
        });
    }
  },
  mounted() {
    this.findAll();
  }
};
</script>
<style scoped>
.bottom {
  margin-top: 13px;
  line-height: 12px;
}
.clearfix:before,
.clearfix:after {
  display: table;
  content: "";
}

.clearfix:after {
  clear: both;
}
.el-card .el-button {
  float: right;
}
.el-card {
  margin-bottom: 15px;
}
</style>