<template>

    <div class="modal fade" id="modal-dependentes">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn btn-warning btn-flat btn-sm pull-right" data-js="btn-add-anexo"
                            aria-label="Close" @click="adicionarElmento">
                        <i class='fa fa-plus fa-fw'></i> Adicionar Anexo
                    </button>
                    <h4 class="modal-title">Anexar Documentos</h4>
                </div>
                <div class="modal-body">

                    <div class="row form-anexo" :id="elemento" style="margin-left: 2rem" v-for="elemento in elementos">
                        <div class="form-group col-md-4">
                            <label class="">Nome do Documento</label>
                            <input type="text" name="nomeanexo[]" placeholder="Nome do Anexo" id="" class="form-control"
                                   maxlength="75">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group col-md-5" data-js="anexo">
                            <label class="">Anexar Documento</label>
                            <input type="file" class="form-control" name="anexos[]">
                        </div>
                        <div class="form-group col-md-3">
                            <button class="btn btn-md btn-danger" @click="removerElemento(elemento)"  style="margin-top: 2.5rem">
                            <i class="fa fa-trash-o"></i>
                         </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-flat" data-dismiss="modal">{{texto_botao}}</button>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                elementos: [],
                cont: 0,
                texto_botao: 'Sair'
            }
        },
        methods: {
            adicionarElmento() {
                this.cont++;
                let elemento = 'elemento' +this.cont;
                this.elementos.push(elemento);
                this.texto_botao = 'Salvar';
            },
            removerElemento(elemento){
                let x = document.getElementById(elemento);
                x.remove();
                 if(document.getElementsByClassName('form-anexo').length > 0) {
                     this.texto_botao = 'Salvar';
                 }else{
                     this.texto_botao = 'Sair'
                 }

            }
        }
    }

</script>
<style scoped>

</style>