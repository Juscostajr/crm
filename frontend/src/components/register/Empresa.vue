<template>
    <el-dialog title="Cadastrar Empresa" :visible.sync="teste">
        <el-form :model="form">
            <el-form-item label="Nome" :label-width="formLabelWidth">
                <el-input v-model="form.nome" auto-complete="off"></el-input>
            </el-form-item>

            <el-form-item label="Telefones" :label-width="formLabelWidth">
                <el-input v-model="form.telefones" auto-complete="off"></el-input>
            </el-form-item>

            <el-form-item label="Endereços" :label-width="formLabelWidth">
                <el-input v-model="form.enderecos" auto-complete="off"></el-input>
            </el-form-item>

            <el-form-item label="E-Mail" :label-width="formLabelWidth">
                <el-input v-model="form.email" auto-complete="off"></el-input>
            </el-form-item>

            <el-form-item label="Razao Social" :label-width="formLabelWidth">
                <el-input v-model="form.razaoSocial" auto-complete="off"></el-input>
            </el-form-item>

            <el-form-item label="Ramo de Atividade" :label-width="formLabelWidth">
                <el-input v-model="form.ramoAtividade" auto-complete="off"></el-input>
            </el-form-item>

            <el-form-item label="Nome Fantasia" :label-width="formLabelWidth">
                <el-input v-model="form.nomeFantasia" auto-complete="off"></el-input>
            </el-form-item>

            <el-form-item label="Inscrição Estadual" :label-width="formLabelWidth">
                <el-input v-model="form.inscricaoEstadual" auto-complete="off"></el-input>
            </el-form-item>

            <el-form-item label="numeroFuncionarios" :label-width="formLabelWidth">
                <el-input v-model="form.numeroFuncionarios" auto-complete="off"></el-input>
            </el-form-item>

            <el-form-item label="Representante Legal" :label-width="formLabelWidth">
                <el-input v-model="form.representanteLegal" auto-complete="off"></el-input>
            </el-form-item>
        </el-form>
            <span slot="footer" class="dialog-footer">
                <el-button @click="dialogFormVisible = false">Cancelar</el-button>
                <el-button type="primary" @click="save">Salvar</el-button>
            </span>
    </el-dialog>
</template>
<script>
    export default {
        props: ['teste'],
        data () {
            return {
                formLabelWidth: '120px',
                form: {domains: [{
                    key: 1,
                    value: ''
                }],
                dialogFormVisible: true,

                },
            }
        },
        watch: {
            teste() {
                this.$emit('update:teste', this.teste)
            }
        },
        components: {},
        methods: {
            save() {
                var self = this;
                axios.post('http://localhost:8080/pj', this.form)
                        .then(function (response) {
                            self.findAll();
                            self.clearForm();
                            self.dialogFormVisible = false;
                            self.$notify({
                                title: 'Sucesso!',
                                message: 'Empresa salva corretamente',
                                type: 'success'
                            });
                            console.log(response);
                        })
                        .catch(function (error) {
                            self.$notify.error({
                                title: 'Erro!',
                                message: error
                            });
                        });

            },
            clearForm(){
                this.form = {};
            },
            removeDomain(item) {
                var index = this.form.domains.indexOf(item);
                if (index !== -1) {
                    this.form.domains.splice(index, 1);
                }
            },
            addDomain() {
                this.form.domains.push({
                    key: Date.now(),
                    value: ''
                });
            }
        },
    }

</script>
<style></style>