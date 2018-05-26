<template>
    <div>
    <h2>{{msg}}</h2>
    <el-card class="box-card">
        <div slot="header" class="clearfix">
            Cobertura
        </div>
        <mapa></mapa>
    </el-card>
    </div>
</template>
<script>
    import Mapa from '../components/Mapa.vue';
    export default {
        data () {
            return {
                msg: 'Pré-Venda'
            }
        },
        components: { Mapa },
        methods: {},
    }
</script>
<style></style>