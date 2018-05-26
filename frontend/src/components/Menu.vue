<template>
<el-menu theme="dark" :default-active="3" class="el-menu-demo" mode="horizontal"
         @select="handleSelect">
    <el-col :push="16">
        <el-menu-item index="1">
            <el-badge is-dot class="item">
                <el-dropdown>
                    <el-button icon="message" type="primary">e-mail<i class="el-icon-caret-bottom el-icon--right"></i></el-button>
                    <el-dropdown-menu slot="dropdown">
                        <el-dropdown-item>Action 1</el-dropdown-item>
                        <el-dropdown-item>Action 2</el-dropdown-item>
                        <el-dropdown-item>Action 3</el-dropdown-item>
                        <el-dropdown-item>Action 4</el-dropdown-item>
                        <el-dropdown-item>Action 5</el-dropdown-item>
                    </el-dropdown-menu>
                </el-dropdown>

            </el-badge>
        </el-menu-item>
    </el-col>
</el-menu>
</template>
<script></script>
<style></style>