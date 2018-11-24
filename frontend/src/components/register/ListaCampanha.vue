<template>
<el-dialog :title="title" :visible.sync="dialogVisible" width="80%">
    <el-form :model="form">
        <el-table :data="this.form">
          <el-table-column label="Nome" prop="pessoa.nomeFantasia"/>
          <el-table-column label="Perguntas">
              <template slot-scope="scope">
                  <el-checkbox 
                  v-for="(pergunta, index) in scope.row.perguntas" :key="index" 
                  :label="pergunta.descricao" 
                  :true-label="{
                      pergunta: pergunta, 
                      pessoa: scope.row.pessoa,
                      resposta: true,
                      data: new Date()
                    }" 
                  :false-label="{
                      pergunta: pergunta, 
                      pessoa: scope.row.pessoa,
                      resposta: false,
                      data: new Date()
                    }" 
                   @change="saveStatus"/><br/>
              </template>
          </el-table-column>
          <el-table-column>
            <template slot-scope="scope">
                                <el-button type="success" size="mini" @click="callInteracao(scope.row.pessoa)">
                                    <icon name="phone"/> Interações
                                </el-button>
            </template>
          </el-table-column>
        </el-table>
    </el-form>
     <div slot="footer">
      <el-button @click="dialogVisible = false">Cancelar</el-button>
      <el-button type="success" @click="save">Salvar</el-button>
      {{this.usuario}}
       <interacao :visible.sync="interacaoVisible" :associadoModel="associado"></interacao>
    </div>
</el-dialog>    
</template>
<script>
import Interacao from "./InteracoesAssociado.vue";
export default {
  props: {
    visible: Boolean,
    data: Object
  },
  computed: {
    usuario() {
      // alert(this.$store.state.usuario.login);
    }
  },
  data() {
    return {
      title: "Alterar Senha",
      dialogVisible: false,
      interacaoTipo: "",
      form: [
        {
          pessoa: {},
          pergunta: {},
          resposta: [],
          data: new Date()
        }
      ],
      associado: {
        pessoaJuridica: {}
      },
      interacaoVisible: false,
      errorMessage: {
        404: "Rota não encontrada",
        500: "Ocorreu um erro inesperado no servidor"
      }
    };
  },
  watch: {
    visible() {
      this.dialogVisible = this.visible;
      if (this.dialogVisible) {
        this.form = this.data.target.membros.map(pessoa => {
          return {
            pessoa: pessoa,
            perguntas: this.data.perguntas
          };
        });
      }
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
    },
    saveStatus(value) {
      this.$request.post(`perguntapessoa`, value).then(response => {});
    },
    callInteracao(pessoaJuridica){
      this.associado.pessoaJuridica = pessoaJuridica;
      this.interacaoVisible = true;
    },
    interacaoCallBack(interacao) {}
  },
  components: { Interacao }
};
</script>
<style scoped>
.el-checkbox + .el-checkbox {
  margin-left: 0;
}

.el-checkbox {
  display: block;
}
</style>


