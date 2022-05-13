<div class="modal fade" id="modal-cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                <h4 class="modal-title">Cadastrar Cargo</h4>
            </div>
            <div class="modal-body">
                <formulario
                        validate="true"
                        redirect="true"
                        enc-type="multipart/form-data"
                        rota-redirect="{{route('horario-trabalho.index')}}"
                        id-form="cadastrarHorarioTrabalho"
                        cor-botao="primary"
                        acao="{{route('horario-trabalho.store')}}"
                        metodo="post"
                        nome-botao="Cadastrar"
                        icon-botao="fa fa-save"
                        id-botao="btn-cadastrar"
                        nome-botao-desabilitado="Salvando...">
                    {{csrf_field()}}

                    <div class="row">
                        <div class="form-group col-md-12" id="validar-descricao_periodo">
                            {!! Form::label('descricao_periodo', 'Descricao:') !!}
                            {!! Form::text('descricao_periodo', null, ['class' => 'form-control trigger', 'data-parsley-required' => 'true', 'id' => 'descricao_periodo', 'placeholder' => 'INFOME A DESCRIÇÃO']) !!}
                            <span id="error-descricao_periodo"></span>
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-md-6" id="validar-inicio_expediente">
                            {!! Form::label('inicio_expediente', 'Início do Expediente:') !!}
                            {!! Form::time('inicio_expediente', null, ['class' => 'form-control trigger', 'data-parsley-required' => 'true', 'id' => 'inicio_expediente', 'placeholder' => 'INFOME O INÍCIO DO EXPEDIENTE', 'v-mask' => '["##:##"]']) !!}
                            <span id="error-inicio_expediente"></span>
                        </div>

                        <div class="form-group col-md-6" id="validar-fim_expediente">
                            {!! Form::label('fim_expediente', 'Fim do Expediente:') !!}
                            {!! Form::time('fim_expediente', null, ['class' => 'form-control trigger', 'data-parsley-required' => 'true', 'id' => 'fim_expediente', 'placeholder' => 'INFOME O FIM DO EXPEDIENTE', 'v-mask' => '["##:##"]']) !!}
                            <span id="error-fim_expediente"></span>
                        </div>

                    </div>

                </formulario>
                <div class="modal-footer">

                </div>

            </div>
        </div>

    </div>
</div>
