<template>
    <div id="login">
        <el-row>
            <el-col :span="8" :offset="8">
                <img src="./assets/teste.svg" id="main-brand">
            </el-col>
        </el-row>
        <el-row>
            <el-col :span="8" :offset="8">
                <el-card shadow="always">
                    <el-alert v-if="notAuth" title="Não autorizado" type="error" description="Usuário e/ou senha incorretos" show-icon :closable="false"/>
                    <el-form :model="usuario">
                        <el-form-item label="Usuário">
                            <el-input v-model="usuario.login" placeholder="Informe seu usuário" ref="login"></el-input>
                        </el-form-item>
                        <el-form-item label="Senha">
                            <el-input v-model="usuario.senha" type="password" placeholder="Informe sua senha"></el-input>
                        </el-form-item>
                        <el-button type="primary" @click="auth">Entrar</el-button>
                    </el-form>
                </el-card>
            </el-col>
        </el-row>
    </div>
</template>
<script>
//import routes from './routes';
export default {
  data() {
    return {
      usuario: {
        login: "",
        senha: ""
      },
      notAuth: false
    };
  },
  methods: {
    auth() {
      this.notAuth = false;
      this.$request
        .post("auth", this.usuario)
        .then(response => {
          // this.$router.addRoutes(routes.getRoutes(response.data));
          localStorage.setItem("session", JSON.stringify(response.data));
          this.$emit("autorizado", response.data);
        })
        .catch(error => {
          if (error.response.status === 403) this.notAuth = true;
          this.usuario = { login: "", senha: "" };
          this.$refs.login.focus();
        });
    }
  }
};
</script>
<style>
body {
  background-color: #272635;
}

#main-brand {
  padding: 10%;
  width: 80%;
}
</style>
