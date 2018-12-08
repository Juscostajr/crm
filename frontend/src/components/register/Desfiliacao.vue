<template>
<el-dialog :title="title" :visible.sync="dialogVisible" width="30%">
    <el-form :model="form">
      <el-form-item label="Associado">
          <el-input :value="associado.pessoaJuridica.nomeFantasia" readonly></el-input>
      </el-form-item>
      <el-form-item label="Data">
          <el-date-picker v-model="form.data" format="dd/MM/yyyy"></el-date-picker>
      </el-form-item>
      <el-form-item label="Motivo">
          <el-select v-model="form.motivo">
            <el-option v-for="(motivo,index) in motivoDesfiliacao" :key="index" :value="motivo"></el-option>
          </el-select>
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
export default {
  props: {
    visible: Boolean,
    associado: Object
  },
  computed: {
    usuario() {
      // alert(this.$store.state.usuario.login);
    }
  },
  data() {
    return {
      title: "Desfiliar Associado",
      dialogVisible: false,
      form: {
        data: new Date(),
        motivo: ""
      },
      motivoDesfiliacao: [],
      errorMessage: {
        404: "Rota não encontrada",
        500: "Ocorreu um erro inesperado no servidor"
      }
    };
  },
  watch: {
    visible() {
      this.dialogVisible = this.visible;
      console.log(this.associado);
    },
    dialogVisible() {
      if (!this.dialogVisible) {
        this.$emit("update:visible", this.dialogVisible);
      }
    }
  },
  methods: {
    save() {
      this.form.associado = this.associado;
      this.$request
        .post("desfiliacao", this.form)
        .then(response => {
          this.$notify({
            title: "Sucesso!",
            message: "Desfiliação registrada!",
            type: "success"
          });
          this.$emit("saved", this.form);
          this.dialogVisible = false;
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
  mounted() {
    this.$request.get("desfiliacao/motivo").then(response => {
      this.motivoDesfiliacao = response.data;
    });
  }
};
</script>
<style scoped>
</style>


