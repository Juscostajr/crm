<template>
    <el-select v-model="value8" filterable placeholder="Select">
        <el-option
                v-for="item in options"
                :key="item.value"
                :label="item.label"
                :value="item.value">
        </el-option>
    </el-select>
</template>

<script>
    import axios from 'axios';
    export default {
        name: 'remote-select',
        props: ['call'],
        data() {
            return {
                list: [],
                loading: false,
            }
        },
        mounted() {
            this.remoteMethod();
        },
        methods: {
            remoteMethod()
            {   const self = this;
                axios.get(this.call)
                        .then(function (response) {
                            console.log(response);
                        })
                        .catch(function (error) {
                            console.log(error);
                        })
                        .then(function () {
                            // always executed
                        });
            }
        }
    }
</script>