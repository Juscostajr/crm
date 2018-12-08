<template>
    <el-card class="box-card">
        <div slot="header" class="clearfix">
            {{msg}}
        </div>

        <el-input placeholder="Type something" prefix-icon="el-icon-search"  @change="findPf()" v-model="search">
        </el-input>

        <el-table :data="tableData" v-loading="loading" style="width: 100%" empty-text="Nenhum resultado encontrado.">
            <el-table-column prop="nome" label="Nome"></el-table-column>
            <el-table-column prop="cpf" label="Cpf"></el-table-column>
            <el-table-column label="Data de Nascimento">
               <template slot-scope="scope">
                  {{scope.row.dtNascimento | moment('DD/MM/YYYY')}}
               </template>
            </el-table-column>
            <el-table-column prop="telefones[0].numero" label="Telefones"></el-table-column>
            <el-table-column prop="enderecos[0].logradouro" label="Enderecos"></el-table-column>
            <el-table-column prop="email" label="E-Mail"></el-table-column>
            <el-table-column fixed="right" label="Ação" width="90">
                <template slot-scope="scope">
                    <el-button size="mini" icon="el-icon-edit" @click="handleEdit(scope.row)" circle></el-button>
                    <el-button size="mini" icon="el-icon-delete" type="danger" @click="handleDelete(scope.row)" circle/>
                </template>
            </el-table-column>

        </el-table>

        <hr/>

        <el-row :gutter="20">
            <el-col :span="12" :offset="6">
                <el-pagination :page-size="20" :pager-count="11" layout="prev, pager, next" :total="1000">
                </el-pagination>
            </el-col>
        </el-row>

        <pessoa-fisica :datamodel="dataModel" :visible.sync="dialogFormVisible" @saved="findAll">

        </pessoa-fisica>
        <el-button id="add" type="success" icon="el-icon-plus" circle @click="handleCreate()"></el-button>

    </el-card>
</template>
<script>
import PessoaFisica from "../components/register/PessoaFisica.vue";
export default {
  data() {
    return {
      msg: "Pessoa Física",
      tableData: [],
      dialogFormVisible: false,
      dataModel: null,
      search: "",
      loading: true
    };
  },
  methods: {
    filterTag(value, row) {
      return row.tag === value;
    },
    filterHandler(value, row, column) {
      const property = column["property"];
      return row[property] === value;
    },
    findAll() {
      this.$request
        .get("pf")
        .then(response => {
          this.tableData = response.data;
        })
        .catch(error => {
          console.log(error);
          this.$notify.error({
            title: "Erro!",
            message: "Não foi possível carregar a lista de pessoas"
          });
        })
        .finally(()=>{
          this.loading = false;
        });
        
    },
    findPf() {
      this.$request.get(`pf/${this.search}`).then(response => {
        this.tableData = response.data;
      });
    },
    handleDelete(row) {
      this.$confirm("Você tem certeza que desja excluir este item?")
        .then(_ => {
          this.$request
            .delete(`pf/${row.id}`)
            .then(response => {
              this.$notify({
                type: "success",
                title: "Sucesso",
                message: "Item excuído"
              });
              var index = this.tableData.indexOf(row);
              if (index !== -1) {
                this.tableData.splice(index, 1);
              }
            })
            .catch(error => {
              console.log(error);
              this.$notify.error({
                title: "Erro!",
                message:
                  "Não foi possível excluir o item desejado pois existem movimentações o envolvendo."
              });
            });
          done();
        })
        .catch(_ => {});
    },
    handleCreate() {
      this.dataModel = null;
      this.dialogFormVisible = true;
    },
    handleEdit(data) {
      console.log(data);
      this.dataModel = {
        nome: data.nome,
        telefones: data.telefones,
        enderecos: data.enderecos,
        email: {
          email: data.email
        },
        grupos: data.grupos,
        cpf: {
          numero: data.cpf
        },
        dtNascimento: data.dt_nascimento
      };
      this.dialogFormVisible = true;
    }
  },
  mounted: function() {
    this.findAll();
  },
  components: { PessoaFisica }
};
</script>
<style>
#add {
  position: fixed;
  bottom: 50px;
  right: 50px;
  z-index: 100;
}
</style>