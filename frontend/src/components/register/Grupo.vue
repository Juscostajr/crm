<template>
    <el-dialog title="Cadastrar Grupo" :visible.sync="modal" width="80%">

        <el-form :model="form">
            <el-row :gutter="15">
                <el-col :span="12">
                    <el-form-item label="Descrição">
                        <el-input v-model="form.descricao" auto-complete="off"></el-input>
                    </el-form-item>
                    <el-form-item label="Tipo Grupo">
                        <remote-select data-source="tipogrupo" id="id" label="descricao" :model.sync="form.tipo"></remote-select>
                    </el-form-item>
                </el-col>
                <el-col :span="12">
                    <el-form-item label="Membros">
                        <br/>
                        <el-transfer 
                            filterable 
                            :filter-method="filterMethod" 
                            filter-placeholder="Filtrar Pessoas"
                            :titles="['Pessoas', form.descricao]"
                            v-model="form.membros" 
                            :data="pessoas">
                        </el-transfer>
                    </el-form-item>
                </el-col>
            </el-row>
        </el-form>
        <span slot="footer" class="dialog-footer">
            <el-button @click="modal = false">Cancelar</el-button>
            <el-button type="primary" @click="save">Salvar</el-button>
        </span>
    </el-dialog>
</template>
<script>
import Grupo from "./Grupo.vue";
import RemoteSelect from "../RemoteSelect.vue";
export default {
  props: ["visible", "datamodel"],
  data() {
    return {
      formLabelWidth: "120px",
      form: {
        descricao: "",
        tipo: {},
        membros: []
      },
      dialogFormVisible: true,
      innerVisible: false,
      modal: false,
      pessoas: [
        {
          label: "Campo Mourão",
          key: 1
        }
      ]
    };
  },
  mounted() {
    this.findPessoas();
  },
  watch: {
    modal() {
      this.$emit("update:visible", this.modal);
    },
    visible() {
      this.modal = this.visible;
    },
    datamodel() {
      if (this.datamodel == null) return this.clearForm();
      this.form = this.datamodel;
    }
  },
  components: { Grupo, RemoteSelect },
  methods: {
    save() {
      this.$request
        .post("grupo", this.form)
        .then(response => {
          this.$notify({
            title: "Sucesso!",
            message: "Grupo salvo corretamente",
            type: "success"
          });
          this.clearForm();
          this.modal = false;
          this.$emit("saved", this.form);
        })
        .catch(error => {
          this.$notify.error({
            title: "Erro!",
            message:
              "Não foi possível cadastrar o grupo, consulte a área de sistemas"
          });
        });
    },
    findPessoas() {
      this.$request.get("pessoa").then(response => {
        this.pessoas = response.data.map(pessoa => {
          if (pessoa.hasOwnProperty("nome")) {
            return { key: pessoa.id, label: pessoa.nome };
          }
          if (pessoa.hasOwnProperty("nome_fantasia")) {
            return { key: pessoa.id, label: pessoa.nome_fantasia };
          }
          return;
        });
      });
    },
    clearForm() {
      this.form = {
        descricao: "",
        tipo: {},
        membros: []
      };
    }
  }
};
</script>
<style scope>
.el-input--suffix {
  width: 120px;
}
</style>