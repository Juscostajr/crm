<template>
    <el-dialog title="Cadastrar Servico" :visible.sync="modal" width="80%">
        <el-form :model="form">
            <el-form-item label="Nome">
                <el-input v-model="form.descricao" auto-complete="off"></el-input>
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
            },
            dialogFormVisible: true,
            innerVisible: false,
            modal: false,
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
    methods: {
        save() {
            this.$request.post('servico', this.form)
                .then(response => {
                    this.clearForm();
                    this.dialogFormVisible = false;
                    this.$notify({
                        title: 'Sucesso!',
                        message: 'Servico salva corretamente',
                        type: 'success'
                    });
                    this.$emit("saved", this.form);
                })
                .catch(error => {
                    console.log(error);
                    this.$notify.error({
                        title: 'Erro!',
                        message: 'Não foi possível cadastrar o serviço'
                    });
                });
        }
        ,
        clearForm() {
            this.form = {
                descricao: '',
            }
        }

    }
}

</script>
<style scoped>
.el-input--suffix {
    width: 120px;
}
</style>