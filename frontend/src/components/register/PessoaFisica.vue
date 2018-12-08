<template>
    <el-dialog title="Cadastrar Pessoa" :visible.sync="modal" width="80%" append-to-body>

        <el-form :model="form">
            <el-row :gutter="10">
                <el-col :span="4">
                    <el-form-item label="CPF" :rules="{ required: true, message: 'Informe um cpf válido', trigger:'blur' }">
                        <el-input 
                            v-model="form.cpf.numero" 
                            auto-complete="off" 
                            v-inputmask="'999.999.999-99'"
                        ></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="14">
                    <el-form-item label="Nome">
                        <el-input v-model="form.nome" auto-complete="off"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="4">
                    <el-form-item label="Data de Nascimento">
                        <el-date-picker
                            v-model="form.dtNascimento"
                            type="date"
                            format="dd/MM/yyyy"
                            value-format="yyyy-MM-dd">
                            placeholder="Selecione uma data">
                        </el-date-picker>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="10">
                <el-col :span="12">
                    <el-form-item label="Telefones">
                        <el-row>
                            <el-col :span="24">
                                <el-row v-for="(telefone, index) in form.telefones" :gutter="10" :key="index">
                                    <el-col :span="18">
                                        <el-input v-model="telefone.numero" auto-complete="off" v-inputmask="'(99) 9999[9]-9999'">
                                            <el-select v-model="telefone.tipo" slot="prepend" placeholder="Tipo">
                                                <el-option v-for="tipo in telefoneTipos" :label="tipo | capitalize" :value="tipo" :key="tipo"></el-option>
                                            </el-select>

                                            <el-select v-model="telefone.operadora" value-key="id" slot="append" placeholder="Operadora">
                                                <el-option v-for="operadora in operadoras" :label="operadora.nome" :value="operadora" :key="operadora.id"></el-option>
                                            </el-select>
                                        </el-input>
                                    </el-col>
                                    <el-col :span="6">
                                        <el-button-group>
                                            <el-button type="success" icon="el-icon-plus" @click="addTelefone"></el-button>
                                            <el-button type="danger" icon="el-icon-delete" v-if="index > 0" @click.prevent="removeTelefone(telefone)"></el-button>
                                        </el-button-group>
                                    </el-col>
                                </el-row>
                                <el-row>
                                    <el-col :span="24">
                                        <el-form-item label="Enderecos">
                                            <br>
                                            <el-button type="success" icon="el-icon-plus" size="small" @click="innerVisible = true">
                                                Adicionar
                                            </el-button>
                                            <endereco :isVisible.sync="innerVisible" :enderecos.sync="form.enderecos"></endereco>
                                        </el-form-item>
                                    </el-col>
                                </el-row>
                            </el-col>
                        </el-row>
                    </el-form-item>
                </el-col>
                <el-col :span="12">
            <el-row :gutter="10">
                <el-col :span="24">
                    <el-form-item label="E-Mail">
                        <el-input type="email" v-model="form.email.email" auto-complete="off"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
                    <el-form-item label="Grupos">
                        <remote-select-multiple data-source="grupo" id="id" label="descricao" :model.sync="form.grupos"></remote-select-multiple>
                    </el-form-item>
                    
                </el-col>
            </el-row>
        </el-form>
        <span slot="footer" class="dialog-footer">
            <el-button @click="modal = false">Cancelar</el-button>
            <el-button type="primary" @click="save">Salvar</el-button>
        </span>
    </el-dialog>
</template>
<script>
import Endereco from "./Endereco.vue";
import RemoteSelect from "../RemoteSelect.vue";
import RemoteSelectMultiple from "../RemoteSelectMultiple.vue";
export default {
  props: ["visible", "datamodel"],
  data() {
    return {
      formLabelWidth: "120px",
      form: {
        nome: "",
        telefones: [
          {
            numero: "",
            proprietario: "",
            operadora: {
              id: "",
              nome: ""
            },
            tipo: ""
          }
        ],
        enderecos: [],
        email: {
          email: ""
        },
        grupos: [],
        cpf: {
          numero: ""
        },
        dtNascimento: ""
      },
      dialogFormVisible: true,
      showTelefone: false,
      innerVisible: false,
      formEndereco: {},
      telefoneTipos: [],
      operadoras: [],
      enderecos: [],
      modal: false
    };
  },
  mounted() {
    this.$request
      .get("telefone")
      .then(response => {
        this.telefoneTipos = response.data;
      })
      .catch(function(error) {
        console.log(error);
        this.$notify.error({
          title: "Erro!",
          message: "Não foi possível carregar os tipos de telefone"
        });
      });
    this.$request
      .get("operadora")
      .then(response => {
        this.operadoras = response.data;
      })
      .catch(error => {
        console.log(error);
        this.$notify.error({
          title: "Erro!",
          message: "Não foi possível carregar as operadoras de telefone"
        });
      });
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
  components: { Endereco, RemoteSelect, RemoteSelectMultiple },
  methods: {
    save() {
      this.$request
        .post("pf", this.form)
        .then(response => {
          this.$notify({
            title: "Sucesso!",
            message: "Pessoa salva corretamente",
            type: "success"
          });
          this.modal = false;
          this.clearForm();
          this.$emit("saved", this.form);
        })
        .catch(error => {
          this.$notify.error({
            title: "Erro!",
            message: "Não foi possível cadastrar esta pessoa"
          });
        });
    },
    clearForm() {
      this.form = {
        nome: "",
        telefones: [
          {
            numero: "",
            proprietario: "",
            operadora: {
              id: "",
              nome: ""
            },
            tipo: ""
          }
        ],
        enderecos: [],
        email: {
          email: ""
        },
        grupos: [],
        cpf: {
          numero: ""
        },
        dtNascimento: ""
      };
    },
    removeTelefone(item) {
      var index = this.form.telefones.indexOf(item);
      if (index !== -1) {
        this.form.telefones.splice(index, 1);
      }
    },
    addTelefone() {
      this.form.telefones.push({
        numero: "",
        proprietario: "",
        operadora: "",
        tipo: ""
      });
    }
  }
};
</script>
<style scoped>
.el-input--suffix {
  width: 120px;
}
</style>