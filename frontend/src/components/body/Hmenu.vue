<template>
    <el-menu
            mode="horizontal"
            background-color="#34445f"
    >

        <el-menu-item index="1">Processing Center</el-menu-item>

        <el-submenu index="2">

            <template slot="title">Workspace</template>

            <el-menu-item index="2-1">item one</el-menu-item>
            <el-menu-item index="2-2">item two</el-menu-item>
            <el-menu-item index="2-3">item three</el-menu-item>
            <el-submenu index="2-4">
                <template slot="title">item four</template>
                <el-menu-item index="2-4-1">item one</el-menu-item>
                <el-menu-item index="2-4-2">item two</el-menu-item>
                <el-menu-item index="2-4-3">item three</el-menu-item>
            </el-submenu>
        </el-submenu>
    </el-menu>
</template>
<script>
    export default {
        name: 'h-menu',
    }
</script>
<style></style>