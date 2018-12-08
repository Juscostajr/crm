<template>
    <el-card class="box-card">
        <div slot="header" class="clearfix">
            {{title}}
        </div>

        <el-input placeholder="Nome Fantasia" prefix-icon="el-icon-search" @change="findEmpresa()" v-model="search"></el-input>
        
        <el-table :data="tableData" v-loading="loading"  style="width: 100%" empty-text="Nenhum resultado encontrado.">
            <el-table-column prop="cnpj" label="Cnpj" sortable></el-table-column>
            <el-table-column prop="razaoSocial" label="Razão Social"></el-table-column>
            <el-table-column prop="nomeFantasia" label="Nome Fantasia"></el-table-column>
            <el-table-column prop="telefones[0].numero" label="Telefones"></el-table-column>
            <el-table-column prop="enderecos[0].logradouro" label="Enderecos"></el-table-column>
            <el-table-column prop="email" label="E-Mail"></el-table-column>
            <el-table-column prop="ramoAtividade" label="Ramo de Atividade"></el-table-column>
            <el-table-column prop="inscricaoEstadual" label="Inscrição Est."></el-table-column>
            <el-table-column prop="numeroFuncionarios" label="Funcionarios"></el-table-column>
            <el-table-column prop="representanteLegal.nome" label="Representante Legal"></el-table-column>
            <el-table-column fixed="right" label="Ação" width="90">
                <template slot-scope="scope">
                    <el-button size="mini" icon="el-icon-edit" @click="handleEdit(scope.row)" circle></el-button>
                    <el-button size="mini" icon="el-icon-delete" type="danger" @click="handleDelete(scope.row)" circle/>
                </template>
            </el-table-column>
        </el-table>

        <hr/>

        <cadastrar-empresa :visible.sync="dialogFormVisible" :datamodel="dataModel" @empresa-callback="findAll"></cadastrar-empresa>

        <el-button id="add" type="success" icon="el-icon-plus" circle @click="handleCreate()"></el-button>

    </el-card>
</template>

<script>
import CadastrarEmpresa from "../components/register/Empresa.vue";
export default {
  data() {
    return {
      title: "Empresas",
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
        .get("pj")
        .then(response => {
          this.tableData = response.data;
        })
        .catch(error => {
          console.log(error);
          this.$notify.error({
            title: "Erro!",
            message: "Não foi possível carregar a lista de empresas"
          });
        })
        .finally(()=>{
          this.loading = false;
        });
    },
    findEmpresa() {
      this.$request.get(`pj/${this.search}`).then(response => {
        this.tableData = response.data;
      });
    },
    handleDelete(row) {
      this.$confirm("Você tem certeza que desja excluir esta empresa?")
        .then(_ => {
          this.$request
            .delete(`pj/${row.id}`)
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
      this.dataModel = {
        razaoSocial: data.razaoSocial,
        telefones: data.telefones,
        enderecos: data.enderecos,
        email: {
          email: data.email
        },
        grupos: data.grupos,
        nomeFantasia: data.nomeFantasia,
        inscricaoEstadual: {
          numero: data.inscricaoEstadual
        },
        cnpj: {
          numero: data.cnpj
        },
        numeroFuncionarios: data.numeroFuncionarios,
        representanteLegal: data.representanteLegal,
        ramoAtividade: data.ramoAtividade
      };
      this.dialogFormVisible = true;
    },
    newEmpresa(model) {
      this.findAll();
    }
  },
  mounted: function() {
    this.findAll();
  },
  components: { CadastrarEmpresa }
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