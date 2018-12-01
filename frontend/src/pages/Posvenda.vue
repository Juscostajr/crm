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
                    <el-button size="mini" type="primary" @click="interacaoVisible = true"><icon name="comment-dots"/> Interagir</el-button>
                    <el-button size="mini" type="warning" @click="handleDesfiliar(scope.row)"><icon name="lock"/> Desfiliar</el-button>
                </template>
            </el-table-column>
        </el-table>
    </el-form>
    <desfiliacao :visible.sync="desfiliacaoVisible" :associado="currentAssociado"/>
</el-card>
</div>
</template>
<script>
import Desfiliacao from '../components/register/Desfiliacao.vue';
import Interacao from '../components/register/Interacao.vue';
export default {
  data() {
    return {
      msg: "Posvenda",
      associados: [],
      form: {},
      desfiliacaoVisible: false,
      currentAssociado: {},
      interacaoVisible: false
    };
  },
  components: { Desfiliacao },
  methods: {
      handleDesfiliar(data){
          this.currentAssociado = data;
          this.desfiliacaoVisible = true;
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