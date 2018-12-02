<template>
<el-dialog :title="title" :visible.sync="dialogVisible" width="80%">
    <el-form :model="form">
        <el-table :data="this.form">
          <el-table-column label="Nome" prop="perguntapessoa[0].pessoa.nomeFantasia"/>
          <el-table-column label="Perguntas">
              <template slot-scope="scope">
                  <el-checkbox 
                  v-for="(perguntapessoa, index) in scope.row.perguntapessoa" :key="index" 
                  :label="perguntapessoa.pergunta.descricao"
                  v-model="perguntapessoa.resposta" /><br/>
              </template>
          </el-table-column>
          <el-table-column>
            <template slot-scope="scope">
                                <el-button type="success" size="mini" @click="callInteracao(scope.row.perguntapessoa[0].pessoa)">
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
       <interacao :visible.sync="interacaoVisible" :associadoModel="associado.pessoaJuridica"></interacao>
    </div>
</el-dialog>    
</template>
<script>
import Interacao from "./DetalhesAssociado.vue";
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
      title: "Lista",
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
      listaPessoas: [],
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
        this.$request
          .get(`campanha/respostas/${this.data.id}`)
          .then(response => {
            this.form = response.data.map(pessoa => {
              return { perguntapessoa: pessoa };
            });
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
      for (let pessoa of this.form) {
        for (let perguntapessoa of pessoa.perguntapessoa) {
          setTimeout(() => {
          this.$request
            .post("perguntapessoa", perguntapessoa)
            .then(response => {
              alert("sucesso");
            });  
          }, 200);
        }
      }

      /**
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
         */
    },
    saveStatus(value) {
      console.log(value);
      //this.$request.post(`perguntapessoa`, value).then(response => {});
    },
    callInteracao(pessoaJuridica) {
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


