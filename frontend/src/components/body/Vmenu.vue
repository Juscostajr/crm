<template>
    <el-menu default-active="2" background-color="#353c46" text-color="#fff" :router="true">

        <el-submenu index="prevenda">

            <template slot="title">
                <i class="el-icon-search"></i>
                <span>Pré-Venda</span>
            </template>

            <el-menu-item v-for="(item, index) in menu.prevenda" :key="index" v-if="allowedPages.includes(item.access)" :index="item.route">{{item.title}}</el-menu-item>

        </el-submenu>
        <el-menu-item v-if="allowedPages.includes(menu.venda.access)" :index="menu.venda.route">
            <i class="el-icon-location-outline"></i>
            <span>{{this.menu.venda.title}}</span>
        </el-menu-item>
        <el-menu-item v-if="allowedPages.includes(menu.posVenda.access)" :index="menu.posVenda.route">
            <i class="el-icon-service"></i>
            <span>{{this.menu.posVenda.title}}</span>
        </el-menu-item>
        <el-menu-item v-if="allowedPages.includes(menu.campanha.access)" :index="menu.campanha.route">
            <i class="el-icon-star-off"></i>
            <span>{{this.menu.campanha.title}}</span>
        </el-menu-item>
        <el-submenu index="cadastros">
            <template slot="title">
                <i class="el-icon-tickets"></i>
                <span>Cadastros</span>
            </template>
            <el-menu-item v-for="(item, index) in menu.cadastros" :key="index" v-if="allowedPages.includes(item.access)" :index="item.route">{{item.title}}</el-menu-item>
        </el-submenu>
    </el-menu>
</template>
<script>
export default {
    name: 'v-menu',
    data(){
        return {
            allowedPages: JSON.parse(localStorage.getItem('session')).acessos.map(item => item.rota),
            menu: {
                prevenda: [
                    {access: 'venda', route: 'prevenda', title: 'Prospectar'},
                    {access: 'venda', route: 'registrarVisita', title: 'Registrar Visita'}

                ],
                venda: {access: 'venda', route: 'venda', title: 'Venda'},
                posVenda: {access: 'interacao', route: 'posvenda', title: 'Pós-Venda'},
                campanha: {access: 'campanha', route: 'campanha', title: 'Campanha'},
                cadastros: [
                {access: 'pj', route:'empresa', title:'Empresa'},
                {access: 'pf', route:'pf', title:'Pessoa'},
                {access: 'grupo', route:'grupo', title:'Grupo'},
                {access: 'usuario', route:'usuario', title:'Usuario'},
                {access: 'operadora', route:'operadora', title:'Tel. Operadora'},
                {access: 'pf', route:'perfil', title:'Perfil'},
                {access: 'servico', route:'servico', title:'Servico'},
                {access: 'secao', route:'secao', title:'Seção'},
                {access: 'tipogrupo', route:'tipoGrupo', title:'Tipo Grupo'},
            ]
            }
        }
    }

}
</script>
<style>
.el-aside {
    background-color: #353c46;
    height: 90vh;
}
</style>