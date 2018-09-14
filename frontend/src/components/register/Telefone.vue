<template>
    <el-dialog title="Cadastrar Telefone" :visible.sync="show">
        <el-form :model="form" name="frmTelefone">
            <el-form-item label="Telefone" :label-width="formLabelWidth">
                <el-input v-model="form.nome" auto-complete="off"></el-input>
            </el-form-item>

            <el-form-item label="Telefones" :label-width="formLabelWidth">
                <el-input v-model="form.telefones" auto-complete="off" :disabled="true"></el-input>
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
        data () {
            return {
                msg: 'Telefone'
            }
        },
        watch: {
            telefone()
            {

            },
            show()
            {
                this.$emit('update:show', this.show)
            }
        },
        components: {},
        methods: {
            save() {
                this.$emit('update:telefone', Object.assign({}, this.telefone));
                this.$refs['frmTelefone'].resetFields();
            }
        },

    }
</script>
<style></style>