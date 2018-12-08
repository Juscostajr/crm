<template>
  
    <el-card class="box-card">
        <div slot="header" class="clearfix">
            {{title}}
        </div>

        <el-input placeholder="Login" prefix-icon="el-icon-search" @change="find()" v-model="search"></el-input>

        <el-table :data="tableData" v-loading="loading" style="width: 100%" empty-text="Nenhum resultado encontrado.">
            <el-table-column prop="id" label="Id" sortable width="150"></el-table-column>
            <el-table-column prop="pessoa.nome" label="Nome" width="260"></el-table-column>
            <el-table-column prop="login" label="Login" width="260"></el-table-column>
            <el-table-column fixed="right" label="Ação" width="90">
                <template slot-scope="scope">
                    <el-button size="mini" icon="el-icon-edit" @click="handleEdit(scope.row)" circle></el-button>
                    <el-button size="mini" icon="el-icon-delete" type="danger" @click="handleDelete(scope.row)" circle/>
                </template>
            </el-table-column>
        </el-table>

        <hr/>

        <cadastrar-usuario :visible.sync="dialogFormVisible" :datamodel="dataModel" @saved="findAll"></cadastrar-usuario>

        <el-button id="add" type="success" icon="el-icon-plus" circle @click="handleCreate()"></el-button>

    </el-card>
</template>

<script>
import CadastrarUsuario from "../components/register/Usuario.vue";
export default {
  data() {
    return {
      title: "Usuarios",
      tableData: [],
      dialogFormVisible: false,
      dataModel: null,
      search: "",
      loading: true,
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
        .get("usuario")
        .then(response => {
          this.tableData = response.data;
        })
        .catch(error => {
          console.log(error);
          this.$notify.error({
            title: "Erro!",
            message: "Não foi possível carregar a lista de usuários"
          });
        })
        .finally(()=>{
          this.loading = false;
        });
    },
    find() {
      this.$request.get(`usuario/${this.search}`).then(response => {
        this.tableData = response.data;
      });
    },
    handleDelete(row) {
      this.$confirm("Você tem certeza que desja excluir este item?")
        .then(_ => {
          this.$request
            .delete(`usuario/${row.id}`)
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
      this.dataModel = data;
      this.dialogFormVisible = true;
    }
  },
  mounted: function() {
    this.findAll();
  },
  components: { CadastrarUsuario }
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
