<template>
    <el-row>
        <el-col :span="16">
            <div id="brand">
                <img src="../../assets/teste.svg" height="160px">
            </div>
        </el-col>
        <el-col :span="8">
            <el-dropdown trigger="click">
                <span class="el-dropdown-link">
                    <el-badge :value="12" class="item">
                        <el-button class="share-button" icon="el-icon-bell" type="primary" size="small">
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
                        <el-button class="share-button" icon="el-icon-message" type="primary" size="small">
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
                        <el-button class="share-button" type="primary" size="small" id="user-button">
                            <icon name="user"/> Juscelino
                        </el-button>
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
        background-color: #272635;
        height: 10vh;
    }
    #brand img{
        padding: 10px;
    }
    .el-badge {
    margin-top: 0;
    margin-right: 20px;
    }

    #user-button {
        margin-top: 10px;
    }
</style>