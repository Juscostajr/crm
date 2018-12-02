<template>
    <el-row>
        <senha :visible="senhaVisible"/>
        <el-col :lg="6" :sm="4">
            <div id="brand">
                <img src="../../assets/teste.svg">
            </div>
        </el-col>
        <el-col :lg="4" :sm="6" :offset="14">
            <el-dropdown trigger="click">
                <span class="el-dropdown-link">
                    <el-badge :value="notifications.length" class="item">
                        <el-button class="share-button" icon="el-icon-bell" type="primary" size="small">
                        </el-button>
                    </el-badge>
                </span>
                <el-dropdown-menu slot="dropdown" class="notification-menu">
                    <el-dropdown-item v-for="(notification, index) in notifications" :key="index" :class="notification.type">
                        <el-row>
                          <el-col :span="4">
                              <icon v-if="notification.type == 'feedback'" name="exchange-alt"/>
                              <icon v-if="notification.type == 'interaction'" name="comments"/>
                              <icon v-if="notification.type == 'scheduling'" name="calendar-alt"/>
                          </el-col>
                          <el-col :span="20">
                              <strong>{{notification.title}}</strong>
                              <br/>{{notification.description}}

                          </el-col>
                        </el-row>
                    </el-dropdown-item>
                </el-dropdown-menu>
            </el-dropdown>

            <el-dropdown trigger="click" @command="handleUserCommand">
                <span class="el-dropdown-link">
                    <el-button class="share-button" type="primary" size="small" id="user-button">
                        <icon name="user" /> {{userInfo.nome | limit(8)}}
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
import Senha from "../register/Senha.vue";
export default {
  name: "h-menu",
  data() {
    return {
      user: [
        { icon: "lock", title: "Trocar minha senha", action: "senha" },
        { icon: "sign-out-alt", title: "Logout", action: "logout" }
      ],
      senhaVisible: false,
      userInfo: {
        login: "",
        nome: ""
      },
      notifications: [
        {
          type: "feedback",
          title: "Feedback pendente",
          description: "Unimed Campo Mourão"
        },
        {
          type: "interaction",
          title: "Tempo sem interação",
          description: "Unimed Campo Mourão"
        },
        {
          type: "scheduling",
          title: "Interação agendada",
          description: "Unimed Campo Mourão"
        }
      ]
    };
  },
  methods: {
    handleUserCommand(command) {
      switch (command) {
        case "logout":
          localStorage.removeItem("session");
          this.$emit("logout");
          break;
        case "senha":
          this.senhaVisible = true;
          break;
        default:
          console.error(command);
          break;
      }
    }
  },
  components: { Senha },
  mounted() {
    this.userInfo = JSON.parse(localStorage.getItem("session")).usuario;

    this.$request.get("interacao").then(response => {
    this.notifications =
        response.data
        .filter(interacao => !interacao.hasOwnProperty('feedback'))
        .map(noFeedback => {
            return {
                type: 'feedback',
                title: "Feedback pendente",
                description: `tipo:${noFeedback.tipo} data: ${this.$moment(noFeedback.data)} ${noFeedback.hora}`
            }
        });
      console.log(response.data);
    });
  }
};
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

.notification-menu {
  width: 300px;
}
.el-dropdown-menu .feedback {
  color: #409eff;
  background: #ecf5ff;
}

.el-dropdown-menu .interaction {
  color: #e6a23c;
  background: #fdf6ec;
}

.el-dropdown-menu .scheduling {
  color: #f56c6c;
  background: #fef0f0;
}

.el-dropdown-menu .success {
  color: #67c23a;
  background: #f0f9eb;
}
.el-dropdown-menu__item {
  line-height: 1.1em;
  padding: 1em;
}

.el-dropdown-menu__item .fa-icon {
  height: 2.5em;
  padding: 0;
  width: unset;
  font-size: 0.8em;
}
</style>