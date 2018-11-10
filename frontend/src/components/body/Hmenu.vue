<template>
    <el-row>
        <el-col :lg="6" :sm="4">
            <div id="brand">
                <img src="../../assets/teste.svg">
            </div>
        </el-col>
        <el-col :lg="4" :sm="6" :offset="14">
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

            <el-dropdown trigger="click" @command="handleUserCommand">
                <span class="el-dropdown-link">
                    <el-button class="share-button" type="primary" size="small" id="user-button">
                        <icon name="user" /> Juscelino
                    </el-button>
                </span>
                <el-dropdown-menu slot="dropdown">
                    <el-dropdown-item v-for="item in user" :key="item.title" :command="item.action">
                        <icon :name="item.icon" /> {{item.title}}
                    </el-dropdown-item>
                </el-dropdown-menu>
            </el-dropdown>
        </el-col>
    </el-row>
</template>
<script>
export default {
    name: 'h-menu',
    data() {
        return {
            user: [
                { icon: 'lock', title: 'Trocar minha senha', action: '' },
                { icon: 'sign-out-alt', title: 'Logout', action: 'logout' }
            ]
        }
    },
    methods: {
        handleUserCommand(command) {
            switch (command) {
                case 'logout':
                    localStorage.removeItem('token');
                    this.$emit('logout');
                    break;
                default:
                    console.log(command);
                    break;
            }
        }
    }
}
</script>
<style>
.el-header {
    background-color: #272635;
    height: 10vh;
}

#brand img {
    padding: 10px 25px;
    height: 30px;
}

.el-badge {
    margin-top: 0;
    margin-right: 20px;
}

#user-button {
    margin-top: 10px;
}
</style>