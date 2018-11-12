<template>
<el-dialog :title="title" :visible.sync="dialogVisible" width="30%">
    <el-form :model="form">
      <el-form-item label="Nome">
          <el-input v-model="form.nome"></el-input>
      </el-form-item>
      <el-form-item label="Descrição">
          <el-input v-model="form.descricao"></el-input>
      </el-form-item>
      <el-form-item label="Target">
          <el-input v-model="form.target"></el-input>
      </el-form-item>
      <el-form-item label="Serviço">
          <el-input v-model="form.servico"></el-input>
      </el-form-item>
      <el-form-item label="Início">
          <el-date-picker v-model="form.inicio" format="dd/MM/yyyy"/>
      </el-form-item>
      <el-form-item label="Final">
          <el-date-picker v-model="form.final" format="dd/MM/yyyy"></el-date-picker>
      </el-form-item>
    </el-form>
</el-dialog>    
</template>
<script>
export default {
  props: {
    visible: Boolean,
    data: Object,
  },
  data() {
    return {
      title: "Campanha",
      dialogVisible: false,
      innerData: {},
      form: {
        target: {},
        servico: {},
        feedback: {},
        nome: '',
        descricao: '',
        inicio: '',
        final: '',
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
      this.form.interacao = this.data.id;
      this.$request
        .put("interacao/feedback", this.form)
        .then(response => {
          this.$notify({
            title: "Sucesso!",
            message: "Feedback registrado!",
            type: "success"
          });
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
    }
  }
};
</script>
<style scoped>
</style>


