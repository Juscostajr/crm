<template>
    <div id="app">
        <el-container v-if="autenticado">
            <el-header>
                <h-menu @logout="autenticado = false"></h-menu>
            </el-header>
            <el-container>
                <el-aside width="200px">
                    <v-menu></v-menu>
                </el-aside>

                <el-main>
                    <router-view class="view"></router-view>
                </el-main>
            </el-container>
        </el-container>
        <login v-if="!autenticado" @autorizado="autenticado = true" />
    </div>
</template>

<script>
import HMenu from './components/body/Hmenu.vue';
import VMenu from './components/body/Vmenu.vue';
import Login from './Login.vue';
export default {
    data(){
        return {
            autenticado: false,
        }
    },
    components: { HMenu, VMenu, Login },
    mounted() {
        if(localStorage.getItem('session').token !== null) {
            this.autenticado = true;
        }
    },
}
</script>

<style>
body {
    margin: 0;
    padding: 0;
}

#app {
    font-family: Helvetica, sans-serif;
}


.el-main {
    background-color: #f1f1f1;
}

.el-header {
    padding: 4px;
}

.item {
    margin-top: 10px;
    margin-right: 40px;
}

hr {
    color: #c0c4cc;
    background-color: #c0c4cc;
    height: 1px;
    border: 0;
}

.fa-icon {
    width:  1em;
    height: 1em;
    padding: 0 0.1em;
    max-width: 100%;
    max-height: 100%;
}

.el-date-editor.el-input {
    width: 100%;
}

.el-select.el-input, .el-input, .el-select, .el-select input, .el-input__inner {
    width: 100%;
}
</style>
