<template>
    <el-dialog title="Cadastrar Usuário" :visible.sync="modal" width="80%">

        <el-form :model="form">
            <el-row :gutter="15">
                <el-col :span="12">
                    <el-form-item label="Pessoa">
                        <remote-select data-source="pf" id="id" label="nome" :model.sync="form.pessoa"></remote-select>
                    </el-form-item>
                    <el-form-item label="Login">
                        <el-input v-model="form.login" auto-complete="off"></el-input>
                    </el-form-item>
                    <el-form-item label="Senha">
                        <el-input type="password" v-model="form.senha" auto-complete="off"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="12">
                    <el-form-item label="Perfil de Acesso">
                        <br/>
                        <el-transfer 
                        filterable 
                        filter-placeholder="Filtrar Pessoas" 
                        :titles="['Vetado','Permitido']" 
                        v-model="form.perfils" 
                        :data="perfis"
                        :props="{ key: 'id', label: 'descricao' }">
                        </el-transfer>
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
import Usuario from './Usuario.vue';
import RemoteSelect from '../RemoteSelect.vue';
export default {
    props: ['visible', 'datamodel'],
    data() {
        return {
            formLabelWidth: '120px',
            form: {
                pessoa: {},
                login: '',
                senha: '',
                perfils: [],
                senhaExpirada: false,
            },
            dialogFormVisible: true,
            innerVisible: false,
            modal: false,
            perfis: [],

        }
    },
    mounted() {
        this.findPerfis();
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
    components: { Usuario, RemoteSelect }
    ,
    methods: {
        save() {
            this.form.perfils = this.form.perfils.map(perfil => {
                return {id: perfil}
            });

            this.$request.post('usuario', this.form)
                .then(response => {
                    this.clearForm();
                    this.dialogFormVisible = false;
                    this.$notify({
                        title: 'Sucesso!',
                        message: 'Usuario salvo corretamente',
                        type: 'success'
                    });
                })
                .catch(error => {
                    console.log(error);
                    this.$notify.error({
                        title: 'Erro!',
                        message: 'Não foi possível cadastrar o usuário, consulte a área de sistemas'
                    });
                });
        },
        findPerfis() {
            this.$request.get('perfil')
                .then(response => {
                    this.perfis = response.data;
                });
        }
        ,
        clearForm() {
            this.form = {
                pessoa: {},
                login: '',
                senha: '',
                perfils: [],
                senhaExpirada: false,
            }
        }

    }
}

</script>
<style>
.el-input--suffix {
    width: 120px;
}
</style>