<template>
    <el-row>
        <el-col :span="8" :offset="16">
            <el-dropdown trigger="click">
                <span class="el-dropdown-link">
                    <el-badge :value="12" class="item">
                        <el-button class="share-button" icon="el-icon-bell" type="primary" size="small">Notificações
                        </el-button>
                    </el-badge>
                </span>
                <el-dropdown-menu slot="dropdown">
                    <el-dropdown-item>Action 1</el-dropdown-item>
                    <el-dropdown-item>Action 2</el-dropdown-item>
                    <el-dropdown-item>Action 3</el-dropdown-item>
                    <el-dropdown-item>Action 4</el-dropdown-item>
                    <el-dropdown-item>Action 5</el-dropdown-item>
                </el-dropdown-menu>
            </el-dropdown>
            <el-dropdown trigger="click">
                <span class="el-dropdown-link">
                    <el-badge :value="12" class="item">
                        <el-button class="share-button" icon="el-icon-message" type="primary" size="small">E-Mails
                        </el-button>
                    </el-badge>
                </span>
                <el-dropdown-menu slot="dropdown">
                    <el-dropdown-item>Action 1</el-dropdown-item>
                    <el-dropdown-item>Action 2</el-dropdown-item>
                    <el-dropdown-item>Action 3</el-dropdown-item>
                    <el-dropdown-item>Action 4</el-dropdown-item>
                    <el-dropdown-item>Action 5</el-dropdown-item>
                </el-dropdown-menu>
            </el-dropdown>
            <el-dropdown trigger="click">
                <span class="el-dropdown-link">
                    <el-badge :value="12" class="item">
                        <el-button class="share-button" icon="el-icon-setting" type="primary" size="small">Juscelino
                        </el-button>
                    </el-badge>
                </span>
                <el-dropdown-menu slot="dropdown">
                    <el-dropdown-item>Action 1</el-dropdown-item>
                    <el-dropdown-item>Action 2</el-dropdown-item>
                    <el-dropdown-item>Action 3</el-dropdown-item>
                    <el-dropdown-item>Action 4</el-dropdown-item>
                    <el-dropdown-item>Action 5</el-dropdown-item>
                </el-dropdown-menu>
            </el-dropdown>
        </el-col>
    </el-row>
</template>
<script>
    export default {
        name: 'h-menu',
    }
</script>
<style>
    .el-header {
        background-color: #353535;
        height: 10vh;
    }
</style>