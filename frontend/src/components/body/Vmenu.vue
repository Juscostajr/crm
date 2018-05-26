<template>
    <el-menu
            default-active="2"
            background-color="#212121"
            text-color="#fff"
            :router= "true"
    >

        <el-menu-item index="prevenda">
            <i class="el-icon-search"></i>
            <span>Pré-Venda</span>
        </el-menu-item>
        <el-menu-item index="venda">
            <i class="el-icon-location-outline"></i>
            <span>Venda</span>
        </el-menu-item>
        <el-menu-item index="posvenda">
            <i class="el-icon-service"></i>
            <span>Pós-Venda</span>
        </el-menu-item>
        <el-submenu index="cadastros">
            <template slot="title">
                <i class="el-icon-tickets"></i>
                <span>Cadastros</span>
            </template>
            <el-menu-item index="empresa">Empresa</el-menu-item>
        </el-submenu>
    </el-menu>
</template>
<script>
    export default {
        name: 'v-menu'
    }
</script>
<style></style>