<template>
    <div>
        <h2>{{msg}}</h2>
        <el-card class="box-card">
            <div slot="header" class="clearfix">
                Cobertura
            </div>
            <mapa :coordenadas="coordenadas" type="marker"></mapa>
        </el-card>
    </div>
</template>
<script>
    import Mapa from '../components/Mapa.vue';
    export default {
        data () {
            return {
                msg: 'Pré-Venda',
                coordenadas: [
                    {latitude: -24.04086982060015, longitude: -52.377187129732874},
                    {latitude: -24.041173563330954, longitude: -52.37754118132284},
                    {latitude: -24.04135972787545, longitude: -52.37784158873251},
                    {latitude: -24.04154589215009, longitude: -52.3780561654537},
                    {latitude: -24.041683065653473, longitude: -52.3780561654541},
                    {latitude: -24.04191821988987, longitude: -52.37863352260092},
                    {latitude: -24.04236893097285, longitude: -52.37912704905966},
                    {latitude: -24.042800044441783, longitude: -52.37976877922324},
                ]
            }
        },
        components: {Mapa},
        methods: {},
    }
</script>
<style></style>