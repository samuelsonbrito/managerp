<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                <h4 class="modal-title">Alterar Dados do Dependente</h4>
            </div>
            <div class="modal-body">
                <formulario
                        validate="true"
                        redirect="true"
                        rota-redirect="{{route('colaborador.dependentes', $id)}}"
                        enc-type="multipart/form-data"
                        id-form="alterarDependente"
                        cor-botao="primary"
                        acao="{{route('colaborador.editar.dependente', ['id'])}}"
                        metodo="put"
                        nome-botao="Alterar"
                        icon-botao="fa fa-edit"
                        id-botao="btn-dependente-alterar"
                        nome-botao-desabilitado="Alterando...">
                    {{csrf_field()}}

                    <div class="row">
                        {!! Form::hidden('dependente_id', $id, ['class' => 'form-control', 'data-parsley-required' => 'true', 'id' => 'idEdit']) !!}

                        <div class="form-group col-md-12">
                            {!! Form::label('nome', 'Nome:') !!}
                            {!! Form::text('nome', null, ['class' => 'form-control', 'data-parsley-required' => 'true', 'id' => 'nomeEdit']) !!}
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            {!! Form::label('nome', 'CPF:') !!}
                            {!! Form::text('cpf', null, ['class' => 'form-control', 'data-parsley-required' => 'true', 'id' => 'cpfEdit', 'v-mask'=> "['###.###.###-##']"]) !!}
                        </div>

                        <div class="form-group col-md-6">
                            <label class="">Data de Nascimento:</label><span class="text-red">*</span>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="data_nascimento" class="form-control" id="dataNascimentoEditar" required="required"
                                       v-mask='["##/##/####"]'>
                            </div>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </formulario>
                <div class="modal-footer">

                </div>


            </div>
        </div>

    </div>
</div>
