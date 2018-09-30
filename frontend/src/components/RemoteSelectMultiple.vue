<template>
    <el-select 
        class="remote-select-multiple" 
        v-model="model" 
        filterable 
        multiple 
        remote 
        reserve-keyword 
        :value-key="id"
        placeholder="Digite para buscar" 
        :remote-method="remoteMethod" 
        :loading="loading"

    >
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
            key: '',
            label: '',
            value: '',
        }
    },
    mounted() {
        this.model = []
        this.$request.get(this.dataSource)
            .then(response => {
                this.list = response.data;
            })
            .catch(error => {
                this.$notify.error({
                    title: 'Erro!',
                    message: error
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
.remote-select-multiple,
.remote-select-multiple .el-input {
    width: 100%;
}
</style>
