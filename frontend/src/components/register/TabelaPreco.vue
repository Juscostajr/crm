<template>
    <el-dialog title="Cadastrar Tabela de Preços" :visible.sync="modal" width="30%">
        <el-form :model="form">
            <el-form-item label="Descrição">
                <el-input v-model="form.descricao" auto-complete="off"></el-input>
            </el-form-item>
            <el-form-item label="Valor">
              <el-input-number v-model="form.valor" :precision="2" :step="0.05"/>
            </el-form-item>
        </el-form>
        <span slot="footer" class="dialog-footer">
            <el-button @click="modal = false">Cancelar</el-button>
            <el-button type="primary" @click="save">Salvar</el-button>
        </span>
    </el-dialog>
</template>
<script>
export default {
  props: ["visible", "datamodel"],
  data() {
    return {
      form: {
        descricao: "",
        valor: ""
      },
      dialogFormVisible: true,
      modal: false
    };
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
  methods: {
    save() {
      this.$request
        .post("tabelapreco", this.form)
        .then(response => {
          this.clearForm();

          this.$notify({
            title: "Sucesso!",
            message: "Tabela atualizada",
            type: "success"
          });
          this.$emit("saved", this.form);
        })
        .catch(error => {
          console.log(error);
          this.$notify.error({
            title: "Erro!",
            message: "Não foi possível cadastrar a tabela."
          });
        })
        .finally(() => {
          this.modal = false;
          this.$emit("saved", this.form);
        });
    },
    clearForm() {
      this.form = {
        descricao: ""
      };
    }
  }
};
</script>
<style scoped>
.el-input--suffix {
  width: 120px;
}
</style>