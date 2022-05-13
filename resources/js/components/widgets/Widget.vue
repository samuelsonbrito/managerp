<template>

        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-folder-o"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">{{nome}}</span>
                <span class="info-box-number">{{valor}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>

</template>

<script>
    export default {
        data() {
            return {
                nome:'',
                valor:''
            }
        },
        computed:{
            getContratoInfo: ()=>{

            }
        }
    }
</script>

<style scoped>

</style>