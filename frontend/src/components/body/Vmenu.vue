<template>
    <el-menu default-active="2" background-color="#353c46" text-color="#fff" :router="true">

        <el-submenu index="prevenda">

            <template slot="title">
                <i class="el-icon-search"></i>
                <span>Pré-Venda</span>
            </template>

            <el-menu-item index="prevenda">Prospectar</el-menu-item>
            <el-menu-item index="registrarVisita">Registrar Visita</el-menu-item>

        </el-submenu>
        <el-menu-item index="venda">
            <i class="el-icon-location-outline"></i>
            <span>Venda</span>
        </el-menu-item>
        <el-menu-item index="posvenda">
            <i class="el-icon-service"></i>
            <span>Pós-Venda</span>
        </el-menu-item>
        <el-menu-item index="campanha">
            <i class="el-icon-star-off"></i>
            <span>Campanha</span>
        </el-menu-item>
        <el-submenu index="cadastros">
            <template slot="title">
                <i class="el-icon-tickets"></i>
                <span>Cadastros</span>
            </template>
            <el-menu-item index="empresa">Empresa</el-menu-item>
            <el-menu-item index="pf">Pessoa Física</el-menu-item>
            <el-menu-item index="grupo">Grupo</el-menu-item>
            <el-menu-item index="usuario">Usuário</el-menu-item>
            <el-menu-item index="operadora">Operadora</el-menu-item>
            <el-menu-item index="perfil">Perfil</el-menu-item>
            <el-menu-item index="servico">Serviço</el-menu-item>
            <el-menu-item index="secao">Seção</el-menu-item>
            <el-menu-item index="tipoGrupo">Tipo Grupo</el-menu-item>

        </el-submenu>
    </el-menu>
</template>
<script>
export default {
    name: 'v-menu',

}
</script>
<style>
.el-aside {
    background-color: #353c46;
    height: 90vh;
}
</style>