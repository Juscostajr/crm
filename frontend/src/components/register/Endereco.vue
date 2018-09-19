<template>
   <span>
       <el-dialog
               width="60%"
               title="Cadastro de Endereço"
               :visible.sync="isVisible"
               append-to-body>
           <el-row>
               <el-form-item label="Cep">
                   <el-input v-model="endereco.cep" auto-complete="off" v-inputmask="'99.999-999'" @change="findAddressData()"></el-input>
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
                       <el-input v-model="endereco.nrImovel" auto-complete="off" @change="findCoordinates()"></el-input>
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
           <el-row :gutter="10">
               <el-col :span="12">
                   <el-form-item label="Latitude">
                       <el-input v-model="endereco.coordenadas.latitude" auto-complete="off"></el-input>
                   </el-form-item>
               </el-col>
               <el-col :span="12">
                   <el-form-item label="Longitude">
                       <el-input v-model="endereco.coordenadas.longitude" auto-complete="off"></el-input>
                   </el-form-item>
               </el-col>
           </el-row>
           <span slot="footer" class="dialog-footer">
                <el-button @click="isVisible = false">Cancelar</el-button>
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
    import Map from '../../maps';
    export default {
        props: ['isVisible', 'enderecos'],
        data () {
            return {
                endereco: {
                    cep: '',
                    nrImovel: '',
                    proprietario: '',
                    cidade: '',
                    logradouro: '',
                    complemento: '',
                    coordenadas: {
                        latitude: '',
                        longitude: '',
                    },
                    bairro: '',
                }
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
            },
            findCoordinates(){
                Map.load(google => {
                    new google.maps.Geocoder().geocode({
                            address: `${this.endereco.nrImovel} ${this.endereco.logradouro}, Brasil`,
                            region: 'BR',
                        },
                        (results, status) => {
                            if (status == google.maps.GeocoderStatus.OK && results[0]) {
                                this.endereco.coordenadas.latitude = results[0].geometry.location.lat();
                                this.endereco.coordenadas.longitude = results[0].geometry.location.lng();
                            }
                        })
                });
            },
            findAddressData(){
                this.$viacep.get(`${this.endereco.cep.replace(/[\D]/gi, '')}/json`)
                    .then(response => {
                        this.endereco.logradouro = response.data.logradouro;
                        this.endereco.cidade = response.data.localidade;
                        this.endereco.bairro = response.data.bairro;
                    })
                    .catch(error => {
                        this.$notify.error({
                            title: 'Erro!',
                            message: error
                        });
                    });
            }
        },
    }
</script>
<style></style>