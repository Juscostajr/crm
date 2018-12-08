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
                              <br/>{{notification.comment}}

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
import moment from "moment";
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
      notifications: []
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
          break;
      }
    }
  },
  components: { Senha },
  mounted() {
    this.userInfo = JSON.parse(localStorage.getItem("session")).usuario;

    this.$request.get("interacao").then(response => {
      this.notifications = this.notifications
        .concat(
          response.data
            .filter(interacao => !interacao.hasOwnProperty("feedback"))
            .map(noFeedback => {
              return {
                type: "feedback",
                title: "Feedback pendente",
                comment: `${noFeedback.tipo} - ${moment(noFeedback.data).format(
                  "DD/MM/YYYY"
                )} ${moment(noFeedback.hora).format("HH:mm")}`,
                description: `${noFeedback.pessoa.nomeFantasia}`,
                date: moment(noFeedback.data).format("YYYYMMDDHHmmSS")
              };
            })
        )
        .concat(
          response.data
            .filter(interacao => {
              return moment(interacao.data).diff(moment(), "days") < -90;
            })
            .map(interaction => {
              return {
                type: "interaction",
                title: "Tempo sem interação",
                comment: `${moment(interaction.data).diff(moment(), "days") *
                  -1} dias`,
                description: interaction.pessoa.nomeFantasia,
                date: moment(interaction.data).format("YYYYMMDDHHmmSS")
              };
            })
        )
        .concat(
          response.data
            .filter(interacao => {
              if (!interacao.hasOwnProperty("retorno")) return false;
              return moment(interacao.retorno).diff(moment(), "days") == 0;
            })
            .map(schedule => {
              return {
                type: "scheduling",
                title: "Retorno agendado",
                comment: `Hoje - ${moment(schedule.data).format("HH:mm")}`,
                description: schedule.pessoa.nomeFantasia,
                date: moment(schedule.data).format("YYYYMMDDHHmmSS")
              };
            })
        )
        .sort((a, b) => {
          if (a.date < b.date) return -1;
          if (a.date > b.date) return 1;
          return 0;
        });

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

.el-dropdown-menu {
  max-height: 90vh;
  overflow: auto;
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

/* width */
::-webkit-scrollbar {
  width: 5px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #888;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555;
}
</style>