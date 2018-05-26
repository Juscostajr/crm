<template>
    <div id="app">
        <el-container>
            <el-header>
                <h-menu></h-menu>
            </el-header>
            <el-container>
                <el-aside width="200px">
                    <v-menu></v-menu>
                </el-aside>

                <el-main><router-view class="view"></router-view></el-main>
            </el-container>
        </el-container>
    </div>
</template>

<script>
    import HMenu from './components/body/Hmenu.vue';
    import VMenu from './components/body/Vmenu.vue';
    export default {
        components: { HMenu, VMenu }
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
    .el-header {
        background-color: #34445f;
        height: 10vh;
    }
    .el-aside{
        background-color: #212121;
        height: 90vh;
    }
    .el-main{
        background-color: #f1f1f1;
    }
    .item {
        margin-top: 10px;
        margin-right: 40px;
    }


</style>
