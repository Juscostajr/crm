<template>
    <el-select class="remote-select" v-model="model" :value-key="id" filterable remote reserve-keyword placeholder="Digite o que procura" :remote-method="remoteMethod" :loading="loading">
        <el-option v-for="item in filteredOptions" :key="getKey(item)" :label="getLabel(item)" :value="item">
        </el-option>
    </el-select>
</template>

<script>
export default {
    props: ['dataSource', 'model', 'id', 'label'],
    data() {
        return {
            filteredOptions: [],
            list: [],
            loading: false,
        }
    },
    mounted() {
        this.$request.get(this.dataSource)
            .then(response => {
                this.list = response.data;
            })
            .catch(error => {
                console.log(error);
                this.$notify.error({
                    title: 'Erro!',
                    message: 'Houve um erro inesperado ao tentar carregar opções'
                });
            });
    },
    methods: {
        remoteMethod(query) {
            this.filteredOptions = [];
            if (query === '') return 
            this.loading = true;
            setTimeout(() => {
                this.loading = false;
                this.filteredOptions = this.list.filter(item => {
                    return item[this.label].toLowerCase()
                        .substring(0, 30)
                        .indexOf(query.toLowerCase()) > -1;
                });
            }, 200);
        },
        getKey(item) {
            return item[this.id];
        },
        getLabel(item) {
            return item[this.label];
        }
    },
    watch: {
        model() {
            this.$emit('update:model', this.model);
        }
    }
}
</script>
<style>
.remote-select,
.remote-select .el-input {
    width: 100%;
}
.el-select-dropdown {
    max-width: 400px;
}
</style>
