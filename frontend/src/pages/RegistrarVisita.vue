<template>
    <el-card class="box-card">
        <div slot="header" class="clearfix">
            {{title}}
        </div>
        <el-form :model="venda">
            <el-row>
                <el-col :span="24">
                    <el-form-item label="Empresa">
                        <br>
                        <el-row :gutter="15">
                            <el-col :span="22">
                                <remote-select data-source="pj" id="id" label="nomeFantasia" :model.sync="venda.pessoaJuridica"></remote-select>
                            </el-col>
                            <el-col :span="2">
                                <el-button type="success" @click="handleCreate()" class="new-user-button"><icon name="folder-plus"/></el-button>
                            </el-col>
                        </el-row>
                    </el-form-item>
                </el-col>
            </el-row>

                    <el-button type="primary" @click="vendaVisible = true" class="open-button"><icon name="play"/> Abrir processo de venda</el-button>

        </el-form>
        <cadastrar-empresa :visible.sync="dialogFormVisible" :datamodel="venda.pessoaJuridica" @empresa-callback="empresaCallBack"></cadastrar-empresa>
        <venda :vendaModel="venda" :visible="vendaVisible"></venda>
    </el-card>
</template>

<script>
import RemoteSelect from '../components/RemoteSelect.vue';
import CadastrarEmpresa from '../components/register/Empresa.vue';
import Venda from '../components/register/Venda.vue';
export default {
    data() {
        return {
            title: 'Registrar Visita',
            dialogFormVisible: false,
            venda: {
                pessoaJuridica: {},
                interesses: [],
                interacaos: [],
                etapa: 'Qualificação'
            },
            vendaVisible: false,
        }
    },
    methods: {
        handleCreate() {
            this.dialogFormVisible = true;
        },
        empresaCallBack(pessoaJuridica){
            this.venda.pessoaJuridica = pessoaJuridica;
        }
    },
    components: { RemoteSelect, CadastrarEmpresa, Venda }
}
</script>

<style scoped>
    .open-button {
        margin: 15px 0; 
        float: right;
    }
    .new-user-button {
        width: 100%;
    }
</style>
