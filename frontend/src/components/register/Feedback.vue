<template>
<el-dialog :title="title" :visible.sync="dialogVisible">
  <el-row :gutter="15">
    <el-col :span="7">
      <strong>Cnpj</strong> {{this.data.pessoaJuridica.cnpj}}
    </el-col>
    <el-col :span="9">
      <strong>Razão Social</strong> {{this.data.pessoaJuridica.razaoSocial}}
    </el-col>
    <el-col :span="8">
      <strong>Nome Fantasia</strong> {{this.data.pessoaJuridica.nomeFantasia}}
    </el-col>
  </el-row>
  <hr/>
  <el-row :gutter="15">
    <el-col :span="2">
      <icon v-if="data.sentido == 'out'" name="caret-right"></icon>
      <icon v-if="data.sentido == 'in'" name="caret-left"></icon>
      <icon v-if="data.tipo == 'Visita'" name="user-tie"></icon>
      <icon v-if="data.tipo == 'Telefonema'" name="phone"></icon>
      <icon v-if="data.tipo == 'Email'" name="envelope"></icon>
    </el-col>
    <el-col :span="10">
      <icon name="clock"/> {{ this.data.hora | moment('hh:mm')}} 
      <icon name="calendar"/> {{this.data.data | moment('DD/MM/YYYY')}}
    </el-col>
    <el-col :span="12">
      <strong>Usuário</strong> {{this.data.usuario.pessoa.nome}}
    </el-col>
  </el-row>
    <el-row>
        <el-col :span="24">
          <h4>Anotações</h4>
          <p v-for="anotacao in data.anotacaos" :key="anotacao.id">
            {{anotacao.titulo}}: {{anotacao.descricao}}
          </p>
        </el-col>
      </el-row>
    <el-form :model="form">
      <el-form-item label="Justificativa">
          <el-input v-model="form.justificativa" type="textarea" placeholder=""></el-input>
      </el-form-item>
      <el-row :gutter="15">
        <el-col :span="12">
            <el-form-item label="Data">
                <el-date-picker v-model="form.data" format="dd/MM/yyyy" placeholder="dd/mm/aaaa"></el-date-picker>
            </el-form-item>
        </el-col>
        <el-col :span="12">
            <el-form-item label="Hora">
                <el-time-picker v-model="form.hora" placeholder="hh:mm:ss"></el-time-picker>
            </el-form-item>
        </el-col>
      </el-row>
      <el-form-item label="Percepção de Satisfação">        
          <br/>       
        <el-rate 
            v-model="form.indicador"
            :texts="['Muito Insatisfeito', 'Insatisfeito', 'Regular', 'Satisfeito', 'Muito Satisfeito']"
            show-text
            :low-threshold="-2"
            :high-threshold="2"
        ></el-rate>
    </el-form-item>
    <el-form-item label="Observação">
        <el-input v-model="form.observacao" type="textarea" placeholder=""></el-input>
    </el-form-item>

    </el-form>
    <span slot="footer" class="dialog-footer">
            <el-button @click="dialogVisible = false">Cancelar</el-button>
            <el-button type="primary" @click="save">Salvar</el-button>
        </span>
</el-dialog>    
</template>
<script>
export default {
  props: {
    visible: Boolean,
    data: Object,
    type: {
      validator: function(value) {
        return ["venda", "campanha"].indexOf(value) !== -1;
      },
      required: true
    }
  },
  data() {
    return {
      title: "Feedback",
      dialogVisible: false,
      innerData: {},
      form: {
        justificativa: "",
        data: new Date(),
        hora: new Date(),
        indicador: 0,
        observacao: ""
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
    }
  }
};
</script>
<style scoped>
</style>


