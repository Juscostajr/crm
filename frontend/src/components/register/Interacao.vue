<template>
    <el-dialog title="Interação" :visible.sync="modal" width="80%" append-to-body>

        <el-row :gutter="15">
            <el-col :span="16">
                <b>Razão Social</b> {{pj.razaoSocial}}
            </el-col>
            <el-col :span="8">
                <b>Nome Fantasia</b> {{pj.nomeFantasia}}
            </el-col>
        </el-row>

        <el-form :model="form">
            <el-row :gutter="15">
                <el-col :span="6">
                    <el-form-item label="Usuario">
                        <el-input v-model="form.usuario.pessoa.nome" auto-complete="off" readonly></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="4">
                    <el-form-item label="Data">
                        <el-date-picker v-model="form.data" format="dd/MM/yyyy" readonly></el-date-picker>
                    </el-form-item>
                </el-col>
                <el-col :span="4">
                    <el-form-item label="Hora">
                        <el-time-picker v-model="form.hora" readonly></el-time-picker>
                    </el-form-item>
                </el-col>
                <el-col :span="10">
                    <el-form-item label="Tipo">
                        <el-input v-model="form.tipo"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="15" v-for="(anotacao, index) in form.anotacaos" :key="anotacao.id">
                <el-col :span="4">
                    <el-form-item label="Data">
                        <el-date-picker v-model="anotacao.data" format="dd/MM/yyyy" readonly />
                    </el-form-item>
                </el-col>
                <el-col :span="3">
                    <el-form-item label="Hora">
                        <el-time-picker v-model="anotacao.hora" readonly />
                    </el-form-item>
                </el-col>
                <el-col :span="7">
                    <el-form-item label="Título">
                        <el-input v-model="anotacao.titulo" />
                    </el-form-item>
                </el-col>
                <el-col :span="10">
                    <el-form-item label="Descrição">
                        <el-input v-model="anotacao.descricao">
                            <el-button slot="append" icon="el-icon-delete" v-if="index > 0" @click="removeAnotacao(anotacao)"></el-button>
                        </el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row>
                <el-col :span="5" :push="19">
                    <el-button type="success" icon="el-icon-plus" @click="addAnotacao" id="btn_plus">Acrescentar uma anotação</el-button>
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
function model() {
    return {
        usuario: {
            id: 16,
            pessoa: {
                nome: 'Juscelino Fernandes',
            }
        },
        data: '',
        hora: '',
        tipo: '',
        anotacaos: [
            {
                data: new Date().getTime(),
                hora: new Date().getTime(),
                titulo: '',
                descricao: ''
            }
        ],
    }
}
export default {
    props: ['visible', 'datamodel', 'pj'],
    data() {
        return {
            form: model(),
            dialogFormVisible: true,
            innerVisible: false,
            modal: false,
        }
    },
    watch: {
        modal() {
            if (this.modal == true) this.updateData();
            this.$emit('update:visible', this.modal)
        },
        visible() {
            this.modal = this.visible;
        },
        datamodel() {
            if (this.datamodel != null) {
                this.form = Object.assign(this.form, this.datamodel);
            }
        }
    },
    methods: {
        save() {
            this.$emit('interacao-saved', Object.assign({}, this.form));
            this.form = model();
            this.modal = false;
        }
        ,
        clearForm() {
            this.form = model();
        },
        updateData() {
            this.form.data = new Date().getTime();
            this.form.hora = new Date().getTime();
        },
        addAnotacao() {
            this.form.anotacaos.push(model());
        },
        removeAnotacao(item) {
            var index = this.form.anotacaos.indexOf(item);
            if (index !== -1) {
                this.form.anotacaos.splice(index, 1);
            }
        }

    }
}

</script>
<style>
#btn_plus {
    width: 100%;
}
</style>