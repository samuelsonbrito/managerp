<div class="modal fade" id="modal-cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                <h4 class="modal-title">Cadastrar Novo Dependente</h4>
            </div>
            <div class="modal-body">
                <formulario
                        validate="true"
                        redirect="true"
                        enc-type="multipart/form-data"
                        rota-redirect="{{route('colaborador.dependentes', $id)}}"
                        id-form="cadastrarDependente"
                        cor-botao="primary"
                        acao="{{route('colaborador.cadastrar.dependente')}}"
                        metodo="post"
                        nome-botao="Cadastrar"
                        icon-botao="fa fa-save"
                        id-botao="btn-cadastrar"
                        nome-botao-desabilitado="Salvando...">
                    {{csrf_field()}}

                    <div class="row">
                        {!! Form::hidden('colaborador_id', $id, ['class' => 'form-control', 'data-parsley-required' => 'true', 'id' => 'idColaborador']) !!}

                        <div class="form-group col-md-12">
                            {!! Form::label('nome', 'Nome:') !!}
                            {!! Form::text('nome', null, ['class' => 'form-control', 'data-parsley-required' => 'true', 'id' => 'nomeCadastrar', 'placeholder' => 'DIGITE O DEPENDENTE']) !!}
                            <div id="error-nomeEdit"></div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            {!! Form::label('nome', 'CPF:') !!}
                            {!! Form::text('cpf', null, ['class' => 'form-control', 'data-parsley-required' => 'true', 'id' => 'cpfCadastrar', 'v-mask'=> "['###.###.###-##']", 'placeholder' => 'DIGITE O CPF']) !!}
                            <div id="error-nomeEdit"></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="">Data de Nascimento:</label><span class="text-red">*</span>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="data_nascimento" class="form-control" id="datepicker" required="required"
                                       v-mask='["##/##/####"]' placeholder="Informe a Data de Nascimento" value="">
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
