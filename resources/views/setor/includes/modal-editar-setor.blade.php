<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                <h4 class="modal-title">Alterar Dados do Setor</h4>
            </div>
            <div class="modal-body">
                <formulario
                        validate="true"
                        redirect="true"
                        rota-redirect="{{route('setor.index')}}"
                        enc-type="multipart/form-data"
                        id-form="alterarSetor"
                        cor-botao="primary"
                        acao="{{route('setor.update', ['id'])}}"
                        metodo="put"
                        nome-botao="Alterar"
                        icon-botao="fa fa-edit"
                        id-botao="btn-dependente-alterar"
                        nome-botao-desabilitado="Alterando...">
                    {{csrf_field()}}

                    <div class="row">
                        {!! Form::hidden('setor_id', null, ['class' => 'form-control', 'data-parsley-required' => 'true', 'id' => 'idEdit']) !!}
                        <div class="form-group col-md-12" id="validar-nomeEdit">
                            {!! Form::label('nomeEdit', 'Nome:') !!}
                            {!! Form::text('nomeEdit', null, ['class' => 'form-control trigger', 'data-parsley-required' => 'true', 'id' => 'nomeEdit', 'placeholder' => 'DIGITE O NOME DA UNIDADE']) !!}
                            <span id="error-nomeEdit"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-8" id="validar-unidadeEdit">
                            {!! Form::label('unidadeEdit', 'Unidades:') !!}
                            {!! Form::select('unidadeEdit', $unidades, null, ['class' => 'conselho col-md-12 form-control', 'id' => 'unidadeEdit']) !!}
                            <span id="error-unidadeEdit"></span>
                        </div>
                        <div class="form-group col-md-4" id="validar-insalubridadeEdit">
                            {!! Form::label('insalubridadeEdit', 'Insalubridade:') !!}
                            {!! Form::select('insalubridadeEdit', [0 => 0, 20 => 20, 30 => 30], null, ['class' => 'conselho col-md-12 form-control', 'id' => 'insalubridadeEdit']) !!}
                            <span id="error-insalubridadeEdit"></span>
                        </div>
                    </div>

                </formulario>
                <div class="modal-footer">

                </div>


            </div>
        </div>

    </div>
</div>
