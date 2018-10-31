<template>
    <el-dialog title="Cadastrar Perfil" :visible.sync="modal" width="80%">
        <el-form :model="form">
            <el-form-item label="Nome">
                <el-input v-model="form.descricao" auto-complete="off"></el-input>
            </el-form-item>
            <el-form-item label="Acessos">
                <br/>
                <el-row v-for="(acesso, index) in form.acessos" :key="index" :gutter="15" >
                    <el-col :span="8">
                        <el-select v-model="form.acessos[index].entidade" filterable placeholder="Selecione um acesso">
                            <el-option v-for="(item,index) in listaAcessos" :key="index" :label="item" :value="item"></el-option>
                        </el-select>
                    </el-col>
                    <el-col :span="12">
                        <el-checkbox v-model="form.acessos[index].ler" label="Leitura" border></el-checkbox>
                        <el-checkbox v-model="form.acessos[index].gravar" label="Gravação" border></el-checkbox>
                        <el-checkbox v-model="form.acessos[index].modificar" label="Alteração" border></el-checkbox>
                        <el-checkbox v-model="form.acessos[index].excluir" label="Exclusão" border></el-checkbox>
                    </el-col>
                    <el-col :span="4">
                        <el-button-group>
                            <el-button type="success" icon="el-icon-plus" @click="addAcesso"></el-button>
                            <el-button type="danger" icon="el-icon-delete" v-if="index > 0" @click.prevent="removeAcesso(form.acessos[index])"></el-button>
                        </el-button-group>
                    </el-col>
                </el-row>
            </el-form-item>

        </el-form>
        <span slot="footer" class="dialog-footer">
            <el-button @click="modal = false">Cancelar</el-button>
            <el-button type="primary" @click="save">Salvar</el-button>
        </span>
    </el-dialog>
</template>
<script>
export default {
    props: ['visible', 'datamodel'],
    data() {
        return {
            formLabelWidth: '120px',
            form: {
                descricao: '',
                acessos: [{
                    entidade: '',
                    ler: false,
                    gravar: false,
                    modificar: false,
                    excluir: false,
                }],
            },
            dialogFormVisible: true,
            innerVisible: false,
            modal: false,
            listaAcessos: [],
        }
    },
    watch: {
        modal() {
            this.$emit('update:visible', this.modal)
        },
        visible() {
            this.modal = this.visible;
        },
        datamodel() {
            if (this.datamodel == null) return this.clearForm();
            this.form = this.datamodel;
        }
    },
    mounted() {
        this.$request.get('acesso')
            .then(response => {
                this.listaAcessos = response.data;
            })
    },
    methods: {
        save() {

            this.$request.post('perfil', this.form)
                .then(response => {
                    this.clearForm();
                    this.dialogFormVisible = false;
                    this.$notify({
                        title: 'Sucesso!',
                        message: 'Perfil salva corretamente',
                        type: 'success'
                    });
                })
                .catch(error => {
                    console.log(error);
                    this.$notify.error({
                        title: 'Erro!',
                        message: 'Não foi possível cadastrar o grupo, consulte a área de sistemas'
                    });
                });
        }
        ,
        clearForm() {
            this.form = {
                descricao: '',
            }
        },
        addAcesso(){
            this.form.acessos.push({
                entidade: '',
                ler: false,
                gravar: false,
                modificar: false,
                excluir: false,
            });
        },
        removeAcesso(item){
            var index = this.form.acessos.indexOf(item);
            if (index !== -1) {
                this.form.acessos.splice(index, 1);
            }
        }

    }
}

</script>
<style>
.el-input--suffix {
    width: 120px;
}

.el-select, .el-select .el-input { 
    width: 100%;
}
</style>