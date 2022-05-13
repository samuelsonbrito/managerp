<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                <h4 class="modal-title">Alterar Nome do Anexo</h4>
            </div>
            <div class="modal-body">
                <formulario
                        validate="true"
                        redirect="true"
                        rota-redirect="{{route('colaborador.anexos', $id)}}"
                        enc-type="multipart/form-data"
                        id-form="alterarAnexo"
                        cor-botao="primary"
                        acao="{{route('colaborador.editar.anexo', ['id'])}}"
                        metodo="put"
                        nome-botao="Alterar"
                        icon-botao="fa fa-edit"
                        id-botao="btn-anexo-alterar"
                        nome-botao-desabilitado="Alterando...">
                    {{csrf_field()}}

                    <div class="row">
                        {!! Form::hidden('anexo_id', null, ['class' => 'form-control', 'data-parsley-required' => 'true', 'id' => 'idEdit']) !!}

                        <div class="form-group col-md-12">
                            {!! Form::label('nome', 'Nome:') !!}
                            {!! Form::text('nome_anexo', null, ['class' => 'form-control', 'data-parsley-required' => 'true', 'id' => 'nomeEdit']) !!}
                            <div id="error-nomeEdit"></div>
                        </div>

                    </div>
                </formulario>
                <div class="modal-footer">

                </div>


            </div>
        </div>

    </div>
</div>
