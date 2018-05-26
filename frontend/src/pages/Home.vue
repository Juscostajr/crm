<template>
    <div>
    <h1>{{ msg }}</h1>
    <el-button @click.native="startHacking">Yes!</el-button>
    <i class="el-icon-edit"></i>
    <i class="el-icon-share"></i>
    <i class="el-icon-delete"></i>
    <el-button type="primary" icon="search">Search</el-button>
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