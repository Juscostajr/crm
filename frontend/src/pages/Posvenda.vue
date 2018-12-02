<template>
<div>
<el-card header="Associados">
    <el-form :model="form">
        <el-table :data="associados">
            <el-table-column type="index" width="50"/>
            <el-table-column label="Nome" property="pessoaJuridica.nomeFantasia" />
            <el-table-column label="Data de Filiação">
                <template slot-scope="scope">
                {{scope.row.dataFiliacao | moment('DD/MM/YYYY')}}
                </template>
            </el-table-column>
            <el-table-column label="Valor da Mensalidade" property="valorMensalidade.descricao"/>
            <el-table-column label="Ação">
                <template slot-scope="scope">
                    <el-tooltip content="Interagir" placement="top">    
                    <el-button size="mini" type="primary" @click="handleDetalhesAssociado(scope.row)">
                        <icon name="comment-dots"/>
                    </el-button>
                    </el-tooltip>
                    <el-tooltip content="Desfiliar" placement="top">
                    <el-button size="mini" type="warning" @click="handleDesfiliar(scope.row)">
                        <icon name="lock"/>
                    </el-button>
                    </el-tooltip>
                </template>
            </el-table-column>
        </el-table>
    </el-form>
    <desfiliacao :visible.sync="desfiliacaoVisible" :associado="currentAssociado"/>
    <detalhes-associado :visible.sync="associadoVisible" :associado-model="currentAssociado"></detalhes-associado>
</el-card>
</div>
</template>
<script>
import Desfiliacao from "../components/register/Desfiliacao.vue";
import Interacao from "../components/register/Interacao.vue";
import DetalhesAssociado from "../components/register/DetalhesAssociado.vue";
export default {
  data() {
    return {
      msg: "Posvenda",
      associados: [],
      form: {},
      desfiliacaoVisible: false,
      currentAssociado: {},
      associadoVisible: false
    };
  },
  components: { Desfiliacao, Interacao, DetalhesAssociado },
  methods: {
    handleDesfiliar(data) {
      this.currentAssociado = data.pessoaJuridica;
      this.desfiliacaoVisible = true;
    },
    handleDetalhesAssociado(data) {
      this.currentAssociado = data.pessoaJuridica;
      this.associadoVisible = true;
    }
  },
  mounted() {
    this.$request.get("associado/status/Ativo").then(response => {
      this.associados = response.data;
      console.log(this.associados);
    });
  }
};
</script>
<style></style>