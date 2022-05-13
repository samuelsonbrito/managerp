<div class="modal fade" id="modal-cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                <h4 class="modal-title">Cadastrar Licença</h4>
            </div>
            <div class="modal-body">
                <formulario
                        validate="true"
                        redirect="true"
                        enc-type="multipart/form-data"
                        rota-redirect="{{route('colaborador.licencas', $id)}}"
                        id-form="cadastrarDependente"
                        cor-botao="primary"
                        acao="{{route('colaborador.cadastrar.licenca')}}"
                        metodo="post"
                        nome-botao="Cadastrar"
                        icon-botao="fa fa-save"
                        id-botao="btn-cadastrar"
                        nome-botao-desabilitado="Salvando...">
                    {{csrf_field()}}

                    <div class="row">
                        {!! Form::hidden('colaborador_id', $id, ['class' => 'form-control', 'data-parsley-required' => 'true', 'id' => 'idColaborador']) !!}

                        <div class="form-group col-md-12">
                            {!! Form::label('tipo', 'Tipo:') !!}
                            {!! Form::select('tipo', $licencas, '' , ['class' => 'tipo col-md-12 form-control select2', 'id' => 'tipo', 'placeholder'=> '']) !!}
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="">INÍCIO:</label><span class="text-red">*</span>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="inicio" class="form-control" id="inicio" required="required"
                                       v-mask='["##/##/####"]' placeholder="Informe a Data Inicial" value="">
                            </div>
                            <span class="help-block"></span>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="">FIM:</label><span class="text-red">*</span>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="fim" class="form-control" id="fim" required="required"
                                       v-mask='["##/##/####"]' placeholder="Informe a Data Final" value="">
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
