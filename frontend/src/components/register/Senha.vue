<template>
<el-dialog :title="title" :visible.sync="dialogVisible" width="30%">
    <el-form :model="form" :rules="rules2" ref="ruleForm2">
      <el-form-item label="Senha atual">
          <el-input v-model="form.senha" type="password"></el-input>
      </el-form-item>
      <el-form-item label="Nova senha" prop="novaSenha">
          <el-input v-model="form.novaSenha" type="password"></el-input>
      </el-form-item>
      <el-form-item label="Repita a nova senha" prop="novaSenhaRpt">
          <el-input v-model="form.novaSenhaRpt" type="password"></el-input>
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
    visible: Boolean
  },
  computed:{
      usuario(){
       // alert(this.$store.state.usuario.login);
      }
  },
  data() {
    var validatePass = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Favor digite sua senha"));
      } else {
        if (this.form.novaSenhaRpt !== "") {
          this.$refs.ruleForm2.validateField("checkPass");
        }
        callback();
      }
    };
    var validatePass2 = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Por favor digite uma senha"));
      } else if (value !== this.form.novaSenha) {
        callback(new Error("As senhas não conferem!"));
      } else {
        callback();
      }
    };
    return {
      title: "Alterar Senha",
      dialogVisible: false,
      form: {
        usuario: localStorage.getItem('token'),
        senha: "",
        novaSenha: "",
        novaSenhaRpt: ""
      },
      rules2: {
        novaSenha: [{ validator: validatePass, trigger: "blur" }],
        novaSenhaRpt: [{ validator: validatePass2, trigger: "blur" }]
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
      }
    }
  },
  methods: {
    save() {
      this.$request
        .put("senha", this.form)
        .then(response => {
          this.$notify({
            title: "Sucesso!",
            message: "Senha alterada!",
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


