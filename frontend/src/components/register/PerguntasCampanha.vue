<template>
<el-dialog :title="title" :visible.sync="dialogVisible" width="30%">
    <el-form :model="form">
      <el-form-item :label="`Pergunta ${index}`" v-for="(pergunta, index) in form.perguntas" :key="index">
          <el-input v-model="pergunta.descricao"></el-input>
      </el-form-item>
    </el-form>
    <el-button type="success" @click="addPergunta" icon="el-icon-plus"></el-button>
    <div slot="footer">
      <el-button @click="dialogVisible = false">Cancelar</el-button>
      <el-button type="success" @click="save">Salvar</el-button>
      {{this.usuario}}
    </div>
</el-dialog>    
</template>
<script>
export default {
  props: {
    visible: Boolean,
    data: Object
  },
  data() {
    return {
      title: "Perguntas a serem respondidas",
      dialogVisible: false,
      innerData: {},
      form: {
        perguntas: [
          {
            descricao: ""
          }
        ]
      },
      errorMessage: {
        404: "Rota não encontrada",
        500: "Ocorreu um erro inesperado no servidor"
      }
    };
  },
  watch: {
    visible() {
      this.dialogVisible = this.visible;
    },
    dialogVisible() {
      if (!this.dialogVisible) {
        this.$emit("update:visible", this.dialogVisible);
        this.$emit("update:data", this.innerData);
      }
    }
  },
  methods: {
    save() {
      this.form.id = this.data.id;
      this.$request
        .put("campanha/perguntas", this.form)
        .then(response => {
          this.$notify({
            title: "Sucesso!",
            message: "Pergunta cadastrada!",
            type: "success"
          });
          this.$emit("saved", this.form);
        })
        .catch(error => {
          let message =
            error.response.hasOwnProperty("status") &&
            this.errorMessage.hasOwnProperty(error.response.status)
              ? this.errorMessage[error.response.status]
              : "Houve um erro inesperado";

          this.$notify.error({
            title: "Erro!",
            message: message
          });
          console.error(error);
        })
        .finally(() => {
          this.dialogVisible = false;
        });
    },
    addPergunta() {
      this.form.perguntas.push({ descricao: "" });
    }
  }
};
</script>
<style scoped>
</style>


