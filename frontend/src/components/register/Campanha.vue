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
        <remote-select data-source='grupo' id='id' label='descricao' :model.sync='form.target'></remote-select>
      </el-form-item>
      <el-form-item label="Serviço">
          <remote-select data-source='servico' id='id' label='descricao' :model.sync='form.servico'></remote-select>
      </el-form-item>
      <el-form-item label="Início">
          <el-date-picker v-model="form.inicio" format="dd/MM/yyyy"/>
      </el-form-item>
      <el-form-item label="Final">
          <el-date-picker v-model="form.final" format="dd/MM/yyyy"></el-date-picker>
      </el-form-item>
    </el-form>
    <div slot="footer">
      <el-button @click="dialogVisible = false">Cancelar</el-button>
      <el-button type="success" @click="save">Salvar</el-button>
      {{this.usuario}}
    </div>
</el-dialog>    
</template>
<script>
import RemoteSelect from '../RemoteSelect.vue'
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
      this.$request
        .post("campanha", this.form)
        .then(response => {
          this.$notify({
            title: "Sucesso!",
            message: "Campanha cadastrada!",
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
  },
  components: {
    RemoteSelect
  }
};
</script>
<style scoped>
</style>


