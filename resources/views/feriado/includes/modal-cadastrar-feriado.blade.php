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
                        rota-redirect="{{route('feriado.index')}}"
                        id-form="cadastrarUnidade"
                        cor-botao="primary"
                        acao="{{route('feriado.store')}}"
                        metodo="post"
                        nome-botao="Cadastrar"
                        icon-botao="fa fa-save"
                        id-botao="btn-cadastrar"
                        nome-botao-desabilitado="Salvando...">
                    {{csrf_field()}}

                        <div class="row">
                            <div class="form-group col-md-12" id="validar-nome">
                                {!! Form::label('descricao', 'Descrição:') !!}
                                {!! Form::text('descricao', null, ['class' => 'form-control trigger', 'data-parsley-required' => 'true', 'id' => 'descricao', 'placeholder' => 'DIGITE A DESCRIÇÃO']) !!}
                                <span id="error-descricao"></span>
                            </div>

                        </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            {!! Form::label('tipo', 'Tipo:') !!}
                            {!! Form::select('tipo', ['NACIONAL' => 'NACIONAL', 'ESTADUAL' => 'ESTADUAL', 'MUNICIPAL' => 'MUNICIPAL'], 0, ['class' => 'conselho col-md-12 form-control', 'id' => 'tipo']) !!}
                        </div>


                            <div class="form-group col-md-4">
                                <label class="">Data:</label><span class="text-red">*</span>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="data_feriado" class="form-control" id="data_feriado" required="required"
                                           v-mask='["##/##/####"]' placeholder="Informe a Data " value="">
                                </div>
                                <span class="help-block"></span>
                            </div>


                        <div class="form-group col-md-4">
                            {!! Form::label('repetir_anualmente', 'Repetir Anualmente:') !!}
                            {!! Form::select('repetir_anualmente', ['1' => 'SIM', '0' => 'NÃO'], 1, ['class' => 'conselho col-md-12 form-control', 'id' => 'repetir_anualmente']) !!}
                        </div>

                    </div>


                </formulario>
                <div class="modal-footer">

                </div>

            </div>
        </div>

    </div>
</div>
