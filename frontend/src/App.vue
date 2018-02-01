<template>
    <div id="app">
        <el-menu theme="dark" :default-active="3" class="el-menu-demo" mode="horizontal"
                 @select="handleSelect">
                <el-col :push="16">
                <el-menu-item index="1">
                    <el-badge is-dot class="item">
                        <el-dropdown>
                            <el-button icon="message" type="primary"><i class="el-icon-caret-bottom el-icon--right"></i></el-button>
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
        <el-row>
            <el-col :xs="4" :sm="4" :md="4" :lg="4">
                <el-menu default-active="2" class="el-menu-vertical-demo" @open="handleOpen" @close="handleClose">
                    <el-submenu index="1">
                        <template slot="title"><i class="el-icon-message"></i>Navigator One</template>
                        <el-menu-item-group title="Group One">
                            <el-menu-item index="1-1">item one</el-menu-item>
                            <el-menu-item index="1-2">item one</el-menu-item>
                        </el-menu-item-group>
                        <el-menu-item-group title="Group Two">
                            <el-menu-item index="1-3">item three</el-menu-item>
                        </el-menu-item-group>
                        <el-submenu index="1-4">
                            <template slot="title">item four</template>
                            <el-menu-item index="1-4-1">item one</el-menu-item>
                        </el-submenu>
                    </el-submenu>
                    <el-menu-item index="2"><i class="el-icon-menu"></i>Navigator Two</el-menu-item>
                    <el-menu-item index="3"><i class="el-icon-setting"></i>Navigator Three</el-menu-item>
                </el-menu>
            </el-col>
            <el-col :xs="8" :sm="8" :md="8" :lg="8">
                <img src="./assets/logo.png">
                <h1>{{ msg }}</h1>
                <el-button @click.native="startHacking">Yes!</el-button>
                <i class="el-icon-edit"></i>
                <i class="el-icon-share"></i>
                <i class="el-icon-delete"></i>
                <el-button type="primary" icon="search">Search</el-button>
            </el-col>
        </el-row>


    </div>
</template>

<script>
    export default {
        data () {
            return {
                msg: 'Want something new?'
            }
        },

        methods: {
            startHacking () {
                this.$notify({
                    title: 'Shhh',
                    message: 'Just be patient...',
                    duration: 6000
                })
            }
        }
    }
</script>

<style>
    #app {
        font-family: Helvetica, sans-serif;
        text-align: center;
    }
</style>
