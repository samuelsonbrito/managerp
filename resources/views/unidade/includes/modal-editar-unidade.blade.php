<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                <h4 class="modal-title">Alterar Dados da Unidade</h4>
            </div>
            <div class="modal-body">
                <formulario
                        validate="true"
                        redirect="true"
                        rota-redirect="{{route('unidade.index')}}"
                        enc-type="multipart/form-data"
                        id-form="alterarUnidade"
                        cor-botao="primary"
                        acao="{{route('unidade.update', ['id'])}}"
                        metodo="put"
                        nome-botao="Alterar"
                        icon-botao="fa fa-edit"
                        id-botao="btn-dependente-alterar"
                        nome-botao-desabilitado="Alterando...">
                    {{csrf_field()}}

                    <div class="row">
                        {!! Form::hidden('unidade_id', null, ['class' => 'form-control', 'data-parsley-required' => 'true', 'id' => 'idEdit']) !!}

                        <div class="form-group col-md-12" id="validar-nomeEdit">
                            {!! Form::label('nomeEdit', 'Nome:') !!}
                            {!! Form::text('nomeEdit', null, ['class' => 'form-control', 'data-parsley-required' => 'true', 'id' => 'nomeEdit']) !!}
                            <span id="error-nomeEdit"></span>
                        </div>

                    </div>

                </formulario>
                <div class="modal-footer">

                </div>


            </div>
        </div>

    </div>
</div>
