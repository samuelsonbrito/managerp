<template>
    <div v-bind:class="'box '+ boxtipo">
        <div class="box-header with-border">
            <h3 class="box-title">{{boxtitulo}}</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>

        <div class="box-body">
           <slot></slot>
        </div>

    </div>
</template>

<script>
    export default {
        name: "Box",
        props:['boxtipo','boxtitulo']
    }
</script>

<style scoped>

</style>