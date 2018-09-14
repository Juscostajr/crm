<template>
   <span>
       <el-dialog
               width="60%"
               title="Cadastro de Endereço"
               :visible.sync="isVisible"
               append-to-body>
           <el-row>
               <el-form-item label="Cep">
                   <el-input v-model="endereco.cep" auto-complete="off"></el-input>
               </el-form-item>
           </el-row>
           <el-row :gutter="10">
               <el-col :span="20">
                   <el-form-item label="Logradouro">
                       <el-input v-model="endereco.logradouro" auto-complete="off"></el-input>
                   </el-form-item>
               </el-col>
               <el-col :span="4">
                   <el-form-item label="Nr">
                       <el-input v-model="endereco.nrImovel" auto-complete="off"></el-input>
                   </el-form-item>
               </el-col>
           </el-row>
           <el-row :gutter="10">
               <el-col :span="8">
                   <el-form-item label="Complemento">
                       <el-input v-model="endereco.complemento" auto-complete="off"></el-input>
                   </el-form-item>
               </el-col>
               <el-col :span="8">
                   <el-form-item label="Bairro">
                       <el-input v-model="endereco.bairro" auto-complete="off"></el-input>
                   </el-form-item>
               </el-col>
               <el-col :span="8">
                   <el-form-item label="Cidade">
                       <el-input v-model="endereco.cidade" auto-complete="off"></el-input>
                   </el-form-item>
               </el-col>
           </el-row>
           <span slot="footer" class="dialog-footer">
                <el-button @click="teste = false">Cancelar</el-button>
                <el-button type="primary" @click="addEndereco(endereco)">Adicionar</el-button>
            </span>
       </el-dialog>
       <el-tag
               :key="endereco.cep + endereco.nrImovel"
               v-for="endereco in enderecos"
               closable
               :disable-transitions="false"
               @close="removerEndereco(endereco)">
           {{endereco.logradouro}}, {{endereco.nrImovel}}
       </el-tag>
   </span>
</template>
<script>
    export default {
        props: ['isVisible','enderecos'],
        data () {
            return {
                endereco: {
                    cep: '',
                    nrImovel: '',
                    proprietario: '',
                    cidade: '',
                    logradouro: '',
                    complemento: '',
                    coordenadas: '',
                    bairro: ''
                },
            }
        },
        watch: {
            isVisible()
            {
                this.$emit('update:isVisible', this.isVisible)
            }
        },
        components: {},
        methods: {
            removerEndereco(item)
            {
                this.enderecos.splice(this.enderecos.indexOf(item), 1);

            },
            addEndereco(e){
                this.enderecos.push(Object.assign({}, e));
                this.endereco = {
                    cep: '',
                    nrImovel: '',
                    proprietario: '',
                    cidade: '',
                    logradouro: '',
                    complemento: '',
                    coordenadas: '',
                    bairro: ''
                }
            }
        },
    }
</script>
<style></style>