<div class="modal fade" id="modal-cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                <h4 class="modal-title">Cadastrar Intervalo</h4>
            </div>
            <div class="modal-body">
                <formulario
                        validate="true"
                        redirect="true"
                        enc-type="multipart/form-data"
                        rota-redirect="{{route('horario-intervalo.index')}}"
                        id-form="cadastrarHorarioIntervalo"
                        cor-botao="primary"
                        acao="{{route('horario-intervalo.store')}}"
                        metodo="post"
                        nome-botao="Cadastrar"
                        icon-botao="fa fa-save"
                        id-botao="btn-cadastrar"
                        nome-botao-desabilitado="Salvando...">
                    {{csrf_field()}}

                    <div class="row">
                        <div class="form-group col-md-6" id="validar-hora_inicial">
                            {!! Form::label('hora_inicial', 'Hora Inicial:') !!}
                            {!! Form::time('hora_inicial', null, ['class' => 'form-control trigger', 'data-parsley-required' => 'true', 'id' => 'hora_inicial', 'placeholder' => 'INFOME O INÍCIO DO INTERVALO', 'v-mask' => '["##:##"]']) !!}
                            <span id="error-hora_inicial"></span>
                        </div>

                        <div class="form-group col-md-6" id="validar-hora_final">
                            {!! Form::label('hora_final', 'Hora Final:') !!}
                            {!! Form::time('hora_final', null, ['class' => 'form-control trigger', 'data-parsley-required' => 'true', 'id' => 'hora_final', 'placeholder' => 'INFOME O FIM DO INTERVALO', 'v-mask' => '["##:##"]']) !!}
                            <span id="error-hora_final"></span>
                        </div>

                    </div>

                </formulario>
                <div class="modal-footer">

                </div>

            </div>
        </div>

    </div>
</div>
